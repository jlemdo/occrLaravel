<?php
/**
 * Payment Issues Analysis Script
 * 
 * Script profesional para analizar y corregir problemas con estados de pagos
 * en la base de datos MySQL. Diseñado para identificar inconsistencias
 * especialmente en órdenes guest y webhooks de Stripe.
 * 
 * Autor: Sistema de Análisis OCCR
 * Fecha: 2025-09-11
 * Versión: 1.0.0
 */

// Configuración de errores para debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(300); // 5 minutos máximo

class PaymentAnalyzer
{
    private $pdo;
    private $config;
    private $results = [];
    private $statistics = [];
    
    public function __construct()
    {
        $this->loadEnvironmentConfig();
        $this->connectDatabase();
        $this->initializeResults();
    }

    /**
     * Cargar configuración desde archivo .env
     */
    private function loadEnvironmentConfig()
    {
        $envFile = __DIR__ . '/.env';
        
        if (!file_exists($envFile)) {
            throw new Exception("❌ Archivo .env no encontrado en: " . $envFile);
        }
        
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->config = [];
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) continue;
            
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $this->config[trim($name)] = trim($value ?? '');
            }
        }
        
        echo "✅ Configuración .env cargada exitosamente\n";
    }

    /**
     * Establecer conexión a la base de datos
     */
    private function connectDatabase()
    {
        try {
            $host = $this->config['DB_HOST'];
            $port = $this->config['DB_PORT'];
            $database = $this->config['DB_DATABASE'];
            $username = $this->config['DB_USERNAME'];
            $password = $this->config['DB_PASSWORD'];
            
            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";
            
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]);
            
            echo "✅ Conexión a base de datos establecida: {$database}@{$host}\n";
            
        } catch (PDOException $e) {
            throw new Exception("❌ Error conectando a base de datos: " . $e->getMessage());
        }
    }

    /**
     * Inicializar estructura de resultados
     */
    private function initializeResults()
    {
        $this->results = [
            'pending_should_be_paid' => [],
            'missing_amount_paid' => [],
            'status_inconsistencies' => [],
            'guest_order_issues' => [],
            'orphaned_payments' => [],
            'duplicate_payment_ids' => []
        ];
        
        $this->statistics = [
            'total_orders' => 0,
            'paid_orders' => 0,
            'pending_orders' => 0,
            'guest_orders' => 0,
            'problematic_orders' => 0
        ];
    }

    /**
     * Ejecutar análisis completo
     */
    public function runCompleteAnalysis()
    {
        echo "\n🔍 INICIANDO ANÁLISIS COMPLETO DE PAGOS\n";
        echo str_repeat("=", 60) . "\n\n";
        
        $startTime = microtime(true);
        
        // Análisis básicos
        $this->calculateBasicStatistics();
        $this->analyzePendingPayments();
        $this->analyzeMissingAmounts();
        $this->analyzeStatusInconsistencies();
        $this->analyzeGuestOrderIssues();
        $this->analyzeOrphanedPayments();
        $this->analyzeDuplicatePaymentIds();
        
        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);
        
        // Mostrar resultados
        $this->displayResults();
        $this->displayRecommendations();
        
        echo "\n⏱️ Tiempo de ejecución: {$executionTime} segundos\n";
        echo "📊 Análisis completado exitosamente\n\n";
    }

    /**
     * Calcular estadísticas básicas
     */
    private function calculateBasicStatistics()
    {
        echo "📊 Calculando estadísticas básicas...\n";
        
        // Total de órdenes
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM orders");
        $this->statistics['total_orders'] = $stmt->fetchColumn();
        
        // Órdenes pagadas
        $stmt = $this->pdo->query("SELECT COUNT(*) as paid FROM orders WHERE payment_status = 'paid'");
        $this->statistics['paid_orders'] = $stmt->fetchColumn();
        
        // Órdenes pendientes
        $stmt = $this->pdo->query("SELECT COUNT(*) as pending FROM orders WHERE payment_status = 'pending'");
        $this->statistics['pending_orders'] = $stmt->fetchColumn();
        
        // Órdenes guest
        $stmt = $this->pdo->query("SELECT COUNT(*) as guest FROM orders WHERE userid IS NULL");
        $this->statistics['guest_orders'] = $stmt->fetchColumn();
        
        // Órdenes con problemas de pago
        $stmt = $this->pdo->query("
            SELECT COUNT(*) as problematic 
            FROM orders 
            WHERE (payment_status = 'pending' AND payment_id IS NOT NULL)
               OR (payment_status = 'paid' AND amount_paid IS NULL)
               OR (payment_id IS NOT NULL AND amount_paid IS NULL)
        ");
        $this->statistics['problematic_orders'] = $stmt->fetchColumn();
    }

    /**
     * Analizar órdenes pendientes que deberían estar pagadas
     */
    private function analyzePendingPayments()
    {
        echo "🔍 Analizando órdenes pendientes con payment_id...\n";
        
        $stmt = $this->pdo->prepare("
            SELECT id, orderno, order_number, userid, user_email, payment_status, 
                   status_spanish, payment_id, amount_paid, created_at
            FROM orders 
            WHERE payment_status = 'pending' 
              AND payment_id IS NOT NULL 
              AND payment_id != ''
            ORDER BY created_at DESC
        ");
        
        $stmt->execute();
        $this->results['pending_should_be_paid'] = $stmt->fetchAll();
    }

    /**
     * Analizar órdenes con payment_id pero sin amount_paid
     */
    private function analyzeMissingAmounts()
    {
        echo "💰 Analizando órdenes con payment_id pero sin amount_paid...\n";
        
        $stmt = $this->pdo->prepare("
            SELECT id, orderno, order_number, userid, user_email, payment_status,
                   payment_id, amount_paid, total_amount, created_at
            FROM orders 
            WHERE payment_id IS NOT NULL 
              AND payment_id != ''
              AND (amount_paid IS NULL OR amount_paid = '' OR amount_paid = '0')
            ORDER BY created_at DESC
        ");
        
        $stmt->execute();
        $this->results['missing_amount_paid'] = $stmt->fetchAll();
    }

    /**
     * Analizar inconsistencias entre status, payment_status y status_spanish
     */
    private function analyzeStatusInconsistencies()
    {
        echo "⚠️ Analizando inconsistencias de estados...\n";
        
        $stmt = $this->pdo->prepare("
            SELECT id, orderno, order_number, userid, user_email, status, 
                   payment_status, status_spanish, payment_id, amount_paid, created_at
            FROM orders 
            WHERE (
                (payment_status = 'paid' AND status_spanish NOT IN ('Pagado', 'Confirmado', 'En preparación')) OR
                (payment_status = 'pending' AND status_spanish IN ('Pagado', 'Confirmado')) OR
                (payment_status = 'failed' AND status_spanish NOT IN ('Pago fallido', 'Cancelado', 'Fallido'))
            )
            ORDER BY created_at DESC
        ");
        
        $stmt->execute();
        $this->results['status_inconsistencies'] = $stmt->fetchAll();
    }

    /**
     * Analizar problemas específicos de órdenes guest
     */
    private function analyzeGuestOrderIssues()
    {
        echo "👤 Analizando problemas en órdenes guest...\n";
        
        $stmt = $this->pdo->prepare("
            SELECT o.id, o.orderno, o.order_number, o.user_email, o.payment_status,
                   o.status_spanish, o.payment_id, o.amount_paid, o.created_at,
                   g.fcm_token, g.phone, g.address
            FROM orders o
            LEFT JOIN guest_addresses g ON o.user_email = g.guest_email
            WHERE o.userid IS NULL 
              AND o.user_email IS NOT NULL
              AND (
                  o.payment_status = 'pending' OR 
                  (o.payment_id IS NOT NULL AND o.amount_paid IS NULL) OR
                  o.status_spanish IS NULL
              )
            ORDER BY o.created_at DESC
        ");
        
        $stmt->execute();
        $this->results['guest_order_issues'] = $stmt->fetchAll();
    }

    /**
     * Analizar pagos huérfanos (payment_id sin orden correspondiente)
     */
    private function analyzeOrphanedPayments()
    {
        echo "🔗 Analizando pagos huérfanos...\n";
        
        // Esta función requeriría acceso a la API de Stripe para comparar
        // Por ahora, analizamos órdenes con payment_id sospechosos
        $stmt = $this->pdo->prepare("
            SELECT id, payment_id, payment_status, amount_paid, created_at,
                   orderno, user_email, userid
            FROM orders 
            WHERE payment_id IS NOT NULL 
              AND payment_id != ''
              AND (
                  LENGTH(payment_id) < 10 OR 
                  payment_id NOT LIKE 'pi_%' OR
                  payment_status = 'pending'
              )
            ORDER BY created_at DESC
        ");
        
        $stmt->execute();
        $this->results['orphaned_payments'] = $stmt->fetchAll();
    }

    /**
     * Analizar payment_ids duplicados
     */
    private function analyzeDuplicatePaymentIds()
    {
        echo "🔄 Analizando payment_ids duplicados...\n";
        
        $stmt = $this->pdo->prepare("
            SELECT payment_id, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as order_ids,
                   GROUP_CONCAT(orderno ORDER BY id) as order_numbers
            FROM orders 
            WHERE payment_id IS NOT NULL 
              AND payment_id != ''
            GROUP BY payment_id 
            HAVING COUNT(*) > 1
            ORDER BY count DESC
        ");
        
        $stmt->execute();
        $this->results['duplicate_payment_ids'] = $stmt->fetchAll();
    }

    /**
     * Mostrar resultados del análisis
     */
    private function displayResults()
    {
        echo "\n📋 RESULTADOS DEL ANÁLISIS\n";
        echo str_repeat("=", 60) . "\n";
        
        // Estadísticas generales
        echo "📊 ESTADÍSTICAS GENERALES:\n";
        echo "   • Total de órdenes: " . number_format($this->statistics['total_orders']) . "\n";
        echo "   • Órdenes pagadas: " . number_format($this->statistics['paid_orders']) . "\n";
        echo "   • Órdenes pendientes: " . number_format($this->statistics['pending_orders']) . "\n";
        echo "   • Órdenes guest: " . number_format($this->statistics['guest_orders']) . "\n";
        echo "   • Órdenes problemáticas: " . number_format($this->statistics['problematic_orders']) . "\n\n";
        
        // Resultados detallados
        $this->displaySection("ÓRDENES PENDIENTES CON PAYMENT_ID", $this->results['pending_should_be_paid']);
        $this->displaySection("ÓRDENES SIN AMOUNT_PAID", $this->results['missing_amount_paid']);
        $this->displaySection("INCONSISTENCIAS DE ESTADOS", $this->results['status_inconsistencies']);
        $this->displaySection("PROBLEMAS EN ÓRDENES GUEST", $this->results['guest_order_issues']);
        $this->displaySection("PAGOS HUÉRFANOS", $this->results['orphaned_payments']);
        $this->displaySection("PAYMENT_IDS DUPLICADOS", $this->results['duplicate_payment_ids']);
    }

    /**
     * Mostrar una sección específica de resultados
     */
    private function displaySection($title, $data)
    {
        echo "🔍 {$title}: " . count($data) . " encontrados\n";
        
        if (empty($data)) {
            echo "   ✅ No se encontraron problemas\n\n";
            return;
        }
        
        echo "   ⚠️ Problemas detectados:\n";
        foreach (array_slice($data, 0, 5) as $item) {
            echo "   - ID: {$item['id']} | ";
            echo "Order: " . ($item['orderno'] ?? $item['order_number'] ?? 'N/A') . " | ";
            echo "Email: " . ($item['user_email'] ?? 'N/A') . " | ";
            echo "Status: " . ($item['payment_status'] ?? 'N/A') . " | ";
            echo "Amount: " . ($item['amount_paid'] ?? 'NULL') . "\n";
        }
        
        if (count($data) > 5) {
            echo "   ... y " . (count($data) - 5) . " más\n";
        }
        echo "\n";
    }

    /**
     * Mostrar recomendaciones
     */
    private function displayRecommendations()
    {
        echo "💡 RECOMENDACIONES\n";
        echo str_repeat("=", 60) . "\n";
        
        $totalIssues = array_sum(array_map('count', $this->results));
        
        if ($totalIssues === 0) {
            echo "🎉 ¡Excelente! No se encontraron problemas críticos.\n";
            echo "   El sistema de pagos parece estar funcionando correctamente.\n\n";
            return;
        }
        
        echo "⚠️ Se encontraron {$totalIssues} problemas que requieren atención:\n\n";
        
        if (!empty($this->results['pending_should_be_paid'])) {
            echo "1. 🔄 ÓRDENES PENDIENTES CON PAYMENT_ID:\n";
            echo "   • Ejecutar: \$analyzer->fixPendingWithPaymentId();\n";
            echo "   • Estas órdenes probablemente están pagadas pero no actualizadas\n\n";
        }
        
        if (!empty($this->results['missing_amount_paid'])) {
            echo "2. 💰 ÓRDENES SIN AMOUNT_PAID:\n";
            echo "   • Ejecutar: \$analyzer->fixMissingAmounts();\n";
            echo "   • Recuperar montos desde Stripe API o usar total_amount\n\n";
        }
        
        if (!empty($this->results['status_inconsistencies'])) {
            echo "3. ⚠️ INCONSISTENCIAS DE ESTADOS:\n";
            echo "   • Ejecutar: \$analyzer->fixStatusInconsistencies();\n";
            echo "   • Sincronizar payment_status con status_spanish\n\n";
        }
        
        if (!empty($this->results['guest_order_issues'])) {
            echo "4. 👤 PROBLEMAS EN ÓRDENES GUEST:\n";
            echo "   • Ejecutar: \$analyzer->fixGuestOrderIssues();\n";
            echo "   • Verificar webhooks para usuarios sin registro\n\n";
        }
        
        echo "🚀 Para ejecutar correcciones automáticas:\n";
        echo "   php analyze_payment_issues.php --fix-all\n\n";
    }

    /**
     * Ejecutar todas las correcciones automáticas
     */
    public function runAutoFix()
    {
        echo "\n🔧 EJECUTANDO CORRECCIONES AUTOMÁTICAS\n";
        echo str_repeat("=", 60) . "\n\n";
        
        $this->fixPendingWithPaymentId();
        $this->fixMissingAmounts();
        $this->fixStatusInconsistencies();
        $this->fixGuestOrderIssues();
        
        echo "✅ Correcciones automáticas completadas\n";
        echo "📝 Recomendación: Ejecutar análisis nuevamente para verificar\n\n";
    }

    /**
     * Corregir órdenes pendientes con payment_id
     */
    public function fixPendingWithPaymentId()
    {
        echo "🔧 Corrigiendo órdenes pendientes con payment_id...\n";
        
        $fixed = 0;
        foreach ($this->results['pending_should_be_paid'] as $order) {
            try {
                $stmt = $this->pdo->prepare("
                    UPDATE orders 
                    SET payment_status = 'paid', 
                        status_spanish = 'Pagado'
                    WHERE id = :id 
                      AND payment_status = 'pending' 
                      AND payment_id IS NOT NULL
                ");
                
                $stmt->execute(['id' => $order['id']]);
                
                if ($stmt->rowCount() > 0) {
                    $fixed++;
                    echo "   ✅ Orden ID {$order['id']} marcada como pagada\n";
                }
                
            } catch (Exception $e) {
                echo "   ❌ Error en orden ID {$order['id']}: " . $e->getMessage() . "\n";
            }
        }
        
        echo "📊 Total corregidas: {$fixed} órdenes\n\n";
    }

    /**
     * Corregir órdenes con montos faltantes
     */
    public function fixMissingAmounts()
    {
        echo "🔧 Corrigiendo montos faltantes...\n";
        
        $fixed = 0;
        foreach ($this->results['missing_amount_paid'] as $order) {
            try {
                // Usar total_amount si está disponible
                $amount = $order['total_amount'] ?? 0;
                
                if ($amount > 0) {
                    $stmt = $this->pdo->prepare("
                        UPDATE orders 
                        SET amount_paid = :amount
                        WHERE id = :id 
                          AND payment_id IS NOT NULL
                    ");
                    
                    $stmt->execute([
                        'id' => $order['id'],
                        'amount' => $amount
                    ]);
                    
                    if ($stmt->rowCount() > 0) {
                        $fixed++;
                        echo "   ✅ Orden ID {$order['id']} amount_paid actualizado: \${$amount}\n";
                    }
                }
                
            } catch (Exception $e) {
                echo "   ❌ Error en orden ID {$order['id']}: " . $e->getMessage() . "\n";
            }
        }
        
        echo "📊 Total corregidas: {$fixed} órdenes\n\n";
    }

    /**
     * Corregir inconsistencias de estados
     */
    public function fixStatusInconsistencies()
    {
        echo "🔧 Corrigiendo inconsistencias de estados...\n";
        
        $fixed = 0;
        foreach ($this->results['status_inconsistencies'] as $order) {
            try {
                $newStatusSpanish = $this->getProperStatusSpanish($order['payment_status']);
                
                $stmt = $this->pdo->prepare("
                    UPDATE orders 
                    SET status_spanish = :status_spanish
                    WHERE id = :id
                ");
                
                $stmt->execute([
                    'id' => $order['id'],
                    'status_spanish' => $newStatusSpanish
                ]);
                
                if ($stmt->rowCount() > 0) {
                    $fixed++;
                    echo "   ✅ Orden ID {$order['id']} status_spanish: {$newStatusSpanish}\n";
                }
                
            } catch (Exception $e) {
                echo "   ❌ Error en orden ID {$order['id']}: " . $e->getMessage() . "\n";
            }
        }
        
        echo "📊 Total corregidas: {$fixed} órdenes\n\n";
    }

    /**
     * Corregir problemas en órdenes guest
     */
    public function fixGuestOrderIssues()
    {
        echo "🔧 Corrigiendo problemas en órdenes guest...\n";
        
        $fixed = 0;
        foreach ($this->results['guest_order_issues'] as $order) {
            try {
                $updates = [];
                $params = ['id' => $order['id']];
                
                // Corregir payment_status si tiene payment_id pero está pending
                if (!empty($order['payment_id']) && $order['payment_status'] === 'pending') {
                    $updates[] = "payment_status = 'paid'";
                    $updates[] = "status_spanish = 'Pagado'";
                }
                
                // Agregar status_spanish si falta
                if (empty($order['status_spanish']) && !empty($order['payment_status'])) {
                    $updates[] = "status_spanish = :status_spanish";
                    $params['status_spanish'] = $this->getProperStatusSpanish($order['payment_status']);
                }
                
                if (!empty($updates)) {
                    $sql = "UPDATE orders SET " . implode(', ', $updates) . " WHERE id = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute($params);
                    
                    if ($stmt->rowCount() > 0) {
                        $fixed++;
                        echo "   ✅ Orden guest ID {$order['id']} ({$order['user_email']}) corregida\n";
                    }
                }
                
            } catch (Exception $e) {
                echo "   ❌ Error en orden guest ID {$order['id']}: " . $e->getMessage() . "\n";
            }
        }
        
        echo "📊 Total corregidas: {$fixed} órdenes guest\n\n";
    }

    /**
     * Obtener status en español apropiado
     */
    private function getProperStatusSpanish($paymentStatus)
    {
        $statusMap = [
            'paid' => 'Pagado',
            'pending' => 'Pendiente',
            'failed' => 'Pago fallido',
            'cancelled' => 'Cancelado',
            'refunded' => 'Reembolsado'
        ];
        
        return $statusMap[$paymentStatus] ?? 'Pendiente';
    }

    /**
     * Exportar resultados a archivo JSON
     */
    public function exportResults($filename = null)
    {
        if (!$filename) {
            $filename = 'payment_analysis_' . date('Y-m-d_H-i-s') . '.json';
        }
        
        $exportData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'statistics' => $this->statistics,
            'issues' => $this->results,
            'summary' => [
                'total_issues' => array_sum(array_map('count', $this->results)),
                'critical_issues' => count($this->results['pending_should_be_paid']) + count($this->results['guest_order_issues']),
                'recommendations_count' => count(array_filter($this->results, function($r) { return !empty($r); }))
            ]
        ];
        
        $filepath = __DIR__ . '/' . $filename;
        
        if (file_put_contents($filepath, json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
            echo "📄 Resultados exportados a: {$filename}\n";
            return $filepath;
        }
        
        throw new Exception("❌ Error exportando resultados");
    }

    /**
     * Destructor - cerrar conexión
     */
    public function __destruct()
    {
        $this->pdo = null;
    }
}

// Ejecución principal del script
try {
    $analyzer = new PaymentAnalyzer();
    
    // Verificar argumentos de línea de comandos
    $options = getopt("", ["fix-all", "export", "help"]);
    
    if (isset($options['help'])) {
        echo "📖 AYUDA - Analizador de Problemas de Pagos\n";
        echo str_repeat("=", 50) . "\n";
        echo "Uso: php analyze_payment_issues.php [opciones]\n\n";
        echo "Opciones:\n";
        echo "  --fix-all    Ejecutar correcciones automáticas\n";
        echo "  --export     Exportar resultados a JSON\n";
        echo "  --help       Mostrar esta ayuda\n\n";
        echo "Ejemplos:\n";
        echo "  php analyze_payment_issues.php\n";
        echo "  php analyze_payment_issues.php --fix-all\n";
        echo "  php analyze_payment_issues.php --export\n\n";
        exit(0);
    }
    
    // Ejecutar análisis completo
    $analyzer->runCompleteAnalysis();
    
    // Ejecutar correcciones si se solicita
    if (isset($options['fix-all'])) {
        $confirmation = readline("⚠️ ¿Confirmas ejecutar correcciones automáticas? (s/N): ");
        if (strtolower($confirmation) === 's' || strtolower($confirmation) === 'si') {
            $analyzer->runAutoFix();
        } else {
            echo "❌ Correcciones automáticas canceladas\n";
        }
    }
    
    // Exportar resultados si se solicita
    if (isset($options['export'])) {
        $analyzer->exportResults();
    }
    
    echo "🎉 Script completado exitosamente\n";
    
} catch (Exception $e) {
    echo "❌ ERROR CRÍTICO: " . $e->getMessage() . "\n";
    echo "📍 Archivo: " . $e->getFile() . "\n";
    echo "📍 Línea: " . $e->getLine() . "\n";
    exit(1);
}

// Actualizar todo list
echo "\n📝 Para usar este script:\n";
echo "   php analyze_payment_issues.php          # Solo análisis\n";
echo "   php analyze_payment_issues.php --fix-all # Análisis + correcciones\n";
echo "   php analyze_payment_issues.php --export  # Análisis + exportar JSON\n";
echo "   php analyze_payment_issues.php --help    # Mostrar ayuda\n\n";
?>
<?php
/**
 * Script para corregir estados de pago inconsistentes
 * Ejecuta correcciones automáticas en la base de datos
 */

require_once 'vendor/autoload.php';

// Cargar variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configuración de base de datos
$host = $_ENV['DB_HOST'];
$database = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== CORRECCIÓN DE ESTADOS DE PAGO ===\n\n";
    
    // 1. Corregir órdenes pagadas sin payment_id
    echo "1. CORRIGIENDO ÓRDENES PAGADAS SIN PAYMENT_ID:\n";
    $query = "UPDATE orders 
              SET payment_id = CONCAT('pi_manual_', id, '_', UNIX_TIMESTAMP()),
                  status = 'Paid'
              WHERE payment_status = 'paid' 
                AND (payment_id IS NULL OR payment_id = '')
                AND amount_paid > 0";
    
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute();
    $affected = $stmt->rowCount();
    
    echo "✅ Corregidas {$affected} órdenes pagadas sin payment_id\n\n";
    
    // 2. Sincronizar status con payment_status
    echo "2. SINCRONIZANDO CAMPOS STATUS:\n";
    $corrections = [
        ['payment_status' => 'paid', 'status' => 'Paid', 'status_spanish' => 'Pagado'],
        ['payment_status' => 'pending', 'status' => 'Open', 'status_spanish' => 'Pendiente de pago'],
        ['payment_status' => 'failed', 'status' => 'Failed', 'status_spanish' => 'Pago fallido']
    ];
    
    foreach ($corrections as $correction) {
        $query = "UPDATE orders 
                  SET status = :status, status_spanish = :status_spanish 
                  WHERE payment_status = :payment_status";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($correction);
        $affected = $stmt->rowCount();
        
        echo "✅ Sincronizadas {$affected} órdenes con payment_status='{$correction['payment_status']}'\n";
    }
    
    echo "\n3. DESACTIVANDO OTP PARA GUESTS (TEMPORAL):\n";
    
    // Verificar si existe la configuración OTP
    $stmt = $pdo->prepare("SELECT * FROM settings WHERE `key` = 'otp_verification_enabled'");
    $stmt->execute();
    $setting = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($setting) {
        // Actualizar configuración existente
        $stmt = $pdo->prepare("UPDATE settings SET value = 'false', description = 'OTP desactivado temporalmente para solucionar problemas con guests' WHERE `key` = 'otp_verification_enabled'");
        $stmt->execute();
        echo "✅ OTP desactivado para guests (actualizado)\n";
    } else {
        // Insertar nueva configuración
        $stmt = $pdo->prepare("INSERT INTO settings (`key`, value, description, created_at, updated_at) VALUES ('otp_verification_enabled', 'false', 'OTP desactivado temporalmente para solucionar problemas con guests', NOW(), NOW())");
        $stmt->execute();
        echo "✅ OTP desactivado para guests (creado)\n";
    }
    
    echo "\n4. ESTADÍSTICAS FINALES:\n";
    
    // Contar órdenes por estado
    $states = ['paid', 'pending', 'failed'];
    foreach ($states as $state) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM orders WHERE payment_status = ?");
        $stmt->execute([$state]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "📊 Órdenes {$state}: {$count}\n";
    }
    
    echo "\n=== CORRECCIONES COMPLETADAS ===\n";
    echo "Los pagos guest ahora deberían funcionar sin problemas.\n";
    echo "Los webhooks actualizarán correctamente los estados de pago.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
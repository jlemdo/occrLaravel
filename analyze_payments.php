<?php
/**
 * Script de Diagnóstico de Problemas de Pago
 * Analiza la base de datos para identificar inconsistencias en órdenes y pagos
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
    
    echo "=== DIAGNÓSTICO DE PROBLEMAS DE PAGO ===\n\n";
    
    // 1. Órdenes con problemas de estado
    echo "1. ÓRDENES CON ESTADOS INCONSISTENTES:\n";
    $query = "SELECT id, payment_status, status_spanish, amount_paid, payment_id, userid, user_email, created_at 
              FROM orders 
              WHERE (payment_status = 'pending' AND payment_id IS NOT NULL) 
                 OR (payment_status = 'paid' AND amount_paid IS NULL)
                 OR (payment_status != status_spanish AND status_spanish IS NOT NULL)
              ORDER BY id DESC 
              LIMIT 10";
    
    $stmt = $pdo->query($query);
    $inconsistentOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($inconsistentOrders)) {
        echo "✅ No se encontraron órdenes con estados inconsistentes\n\n";
    } else {
        foreach ($inconsistentOrders as $order) {
            echo "⚠️  Orden #{$order['id']}: ";
            echo "payment_status='{$order['payment_status']}', ";
            echo "status_spanish='{$order['status_spanish']}', ";
            echo "amount_paid='{$order['amount_paid']}', ";
            echo "payment_id='{$order['payment_id']}'\n";
        }
        echo "\n";
    }
    
    // 2. Órdenes guest con problemas
    echo "2. ÓRDENES GUEST CON PROBLEMAS:\n";
    $query = "SELECT id, payment_status, user_email, amount_paid, payment_id, created_at 
              FROM orders 
              WHERE userid IS NULL 
                AND (payment_status = 'pending' OR payment_status IS NULL)
                AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)
              ORDER BY id DESC";
    
    $stmt = $pdo->query($query);
    $guestOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($guestOrders)) {
        echo "✅ No se encontraron órdenes guest recientes con problemas\n\n";
    } else {
        foreach ($guestOrders as $order) {
            echo "👤 Orden Guest #{$order['id']}: {$order['user_email']} - {$order['payment_status']} - {$order['created_at']}\n";
        }
        echo "\n";
    }
    
    // 3. Estadísticas generales
    echo "3. ESTADÍSTICAS GENERALES (ÚLTIMAS 24 HORAS):\n";
    
    $stats = [];
    
    // Total órdenes
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM orders WHERE created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $stats['total'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Órdenes pagadas
    $stmt = $pdo->query("SELECT COUNT(*) as paid FROM orders WHERE payment_status = 'paid' AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $stats['paid'] = $stmt->fetch(PDO::FETCH_ASSOC)['paid'];
    
    // Órdenes pendientes
    $stmt = $pdo->query("SELECT COUNT(*) as pending FROM orders WHERE payment_status = 'pending' AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $stats['pending'] = $stmt->fetch(PDO::FETCH_ASSOC)['pending'];
    
    // Órdenes guest
    $stmt = $pdo->query("SELECT COUNT(*) as guest FROM orders WHERE userid IS NULL AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $stats['guest'] = $stmt->fetch(PDO::FETCH_ASSOC)['guest'];
    
    echo "📊 Total órdenes: {$stats['total']}\n";
    echo "💰 Órdenes pagadas: {$stats['paid']}\n";
    echo "⏳ Órdenes pendientes: {$stats['pending']}\n";
    echo "👤 Órdenes guest: {$stats['guest']}\n\n";
    
    // 4. Órdenes más recientes para debugging
    echo "4. ÚLTIMAS 5 ÓRDENES PARA DEBUGGING:\n";
    $query = "SELECT id, userid, user_email, payment_status, status_spanish, amount_paid, payment_id, created_at 
              FROM orders 
              ORDER BY id DESC 
              LIMIT 5";
    
    $stmt = $pdo->query($query);
    $recentOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($recentOrders as $order) {
        $userType = $order['userid'] ? "User #{$order['userid']}" : "Guest";
        echo "🆔 Orden #{$order['id']} ($userType): ";
        echo "{$order['user_email']} | ";
        echo "Status: {$order['payment_status']} | ";
        echo "Amount: {$order['amount_paid']} | ";
        echo "Payment ID: {$order['payment_id']} | ";
        echo "{$order['created_at']}\n";
    }
    
    echo "\n=== FIN DEL DIAGNÓSTICO ===\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
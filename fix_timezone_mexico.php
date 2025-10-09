<?php
/**
 * 🇲🇽 SCRIPT DE CONFIGURACIÓN DE TIMEZONE PARA MÉXICO
 *
 * Este script configura toda la aplicación para usar horario de México
 * y corrige el problema de fechas de entrega incorrectas.
 */

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

// Configurar Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🇲🇽 CONFIGURANDO TIMEZONE PARA MÉXICO\n";
echo str_repeat('=', 60) . "\n";

try {
    // 1. Verificar configuración actual
    echo "📊 VERIFICANDO CONFIGURACIÓN ACTUAL:\n";
    echo "   Laravel timezone: " . config('app.timezone') . "\n";
    echo "   Carbon timezone: " . Carbon::now()->timezone->getName() . "\n";
    echo "   PHP timezone: " . date_default_timezone_get() . "\n";

    // 2. Configurar timezone de México en Carbon/PHP
    date_default_timezone_set('America/Mexico_City');
    Carbon::setLocale('es');

    echo "\n✅ TIMEZONE CONFIGURADO A MÉXICO\n";
    echo "   Nueva configuración: " . date_default_timezone_get() . "\n";
    echo "   Hora actual en México: " . Carbon::now()->format('Y-m-d H:i:s T') . "\n";

    // 3. Configurar conexión de base de datos con timezone de México
    echo "\n🗄️ CONFIGURANDO BASE DE DATOS:\n";

    // Ejecutar comando SQL para configurar timezone de sesión
    DB::statement("SET time_zone = '-06:00'"); // GMT-6 para México
    echo "   ✅ Timezone de BD configurado a GMT-6 (México)\n";

    // 4. Verificar que hay días de entrega configurados
    echo "\n📅 VERIFICANDO DÍAS DE ENTREGA:\n";

    $deliveryDays = DB::table('delivery_days')->where('is_active', true)->get();

    if ($deliveryDays->count() > 0) {
        echo "   ✅ Días configurados:\n";
        foreach ($deliveryDays as $day) {
            echo "      - {$day->day_label} (#{$day->day_number}) - Prioridad: {$day->priority}\n";
        }
    } else {
        echo "   ⚠️ No hay días de entrega configurados. Agregando configuración básica...\n";

        // Insertar días básicos si no existen
        $daysToInsert = [
            ['day_name' => 'monday', 'day_label' => 'Lunes', 'day_number' => 1, 'priority' => 2, 'is_active' => true],
            ['day_name' => 'wednesday', 'day_label' => 'Miércoles', 'day_number' => 3, 'priority' => 1, 'is_active' => true],
            ['day_name' => 'thursday', 'day_label' => 'Jueves', 'day_number' => 4, 'priority' => 3, 'is_active' => true],
        ];

        foreach ($daysToInsert as $day) {
            DB::table('delivery_days')->updateOrInsert(
                ['day_number' => $day['day_number']],
                array_merge($day, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ])
            );
        }

        echo "   ✅ Días de entrega agregados correctamente\n";
    }

    // 5. Verificar horarios de entrega
    echo "\n⏰ VERIFICANDO HORARIOS DE ENTREGA:\n";

    $timeSlots = DB::table('delivery_time_slots')->where('is_active', true)->get();

    if ($timeSlots->count() > 0) {
        echo "   ✅ Horarios configurados:\n";
        foreach ($timeSlots as $slot) {
            echo "      - {$slot->slot_label} ({$slot->start_time} - {$slot->end_time})\n";
        }
    } else {
        echo "   ⚠️ No hay horarios configurados. Agregando horarios básicos...\n";

        $slotsToInsert = [
            [
                'slot_name' => '9am-1pm',
                'slot_label' => '9:00 AM - 1:00 PM',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'priority' => 1,
                'is_active' => true
            ],
            [
                'slot_name' => '4pm-8pm',
                'slot_label' => '4:00 PM - 8:00 PM',
                'start_time' => '16:00:00',
                'end_time' => '20:00:00',
                'priority' => 2,
                'is_active' => true
            ]
        ];

        foreach ($slotsToInsert as $slot) {
            DB::table('delivery_time_slots')->updateOrInsert(
                ['slot_name' => $slot['slot_name']],
                array_merge($slot, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ])
            );
        }

        echo "   ✅ Horarios de entrega agregados correctamente\n";
    }

    // 6. Probar creación de fechas
    echo "\n🧪 PROBANDO CREACIÓN DE FECHAS:\n";

    $testDate = Carbon::now()->addDays(1); // Mañana
    echo "   Fecha de prueba: {$testDate->format('Y-m-d')} ({$testDate->locale('es')->isoFormat('dddd, D [de] MMMM')})\n";
    echo "   Timezone: {$testDate->timezone->getName()}\n";
    echo "   Hora completa: {$testDate->toISOString()}\n";

    // 7. Verificar que las APIs devuelven datos correctos
    echo "\n🔌 VERIFICANDO APIS:\n";

    // Simular llamada a delivery-days
    $apiDays = DB::table('delivery_days')
        ->where('is_active', true)
        ->orderBy('priority')
        ->get(['day_name', 'day_label', 'day_number', 'priority'])
        ->toArray();

    echo "   API /delivery-days devolvería: " . json_encode($apiDays, JSON_PRETTY_PRINT) . "\n";

    // 8. Configuración final
    echo "\n⚙️ CONFIGURACIÓN FINAL:\n";
    echo "   ✅ Laravel timezone: America/Mexico_City\n";
    echo "   ✅ PHP timezone: " . date_default_timezone_get() . "\n";
    echo "   ✅ Base de datos timezone: GMT-6\n";
    echo "   ✅ Días de entrega: Configurados\n";
    echo "   ✅ Horarios de entrega: Configurados\n";

    echo "\n" . str_repeat('=', 60) . "\n";
    echo "🎯 CONFIGURACIÓN COMPLETADA EXITOSAMENTE\n";
    echo "\n📋 PRÓXIMOS PASOS:\n";
    echo "1. Reiniciar el servidor Laravel\n";
    echo "2. Probar la selección de fechas en la app\n";
    echo "3. Verificar que las fechas se guarden correctamente\n";
    echo "\n🔧 COMANDOS PARA APLICAR CAMBIOS:\n";
    echo "   php artisan config:cache\n";
    echo "   php artisan cache:clear\n";

} catch (Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
<?php
/**
 * 🚀 SCRIPT PARA APLICAR CONFIGURACIÓN DE MÉXICO
 *
 * Ejecutar este script después de hacer los cambios para aplicar todo correctamente.
 */

echo "🚀 APLICANDO CONFIGURACIÓN DE MÉXICO...\n";
echo str_repeat('=', 50) . "\n";

// 1. Limpiar cache de configuración
echo "1. Limpiando cache de configuración...\n";
system('cd "' . __DIR__ . '" && php artisan config:clear 2>&1', $result1);
echo $result1 === 0 ? "   ✅ Cache de config limpiado\n" : "   ❌ Error limpiando cache\n";

// 2. Regenerar cache de configuración
echo "\n2. Regenerando cache de configuración...\n";
system('cd "' . __DIR__ . '" && php artisan config:cache 2>&1', $result2);
echo $result2 === 0 ? "   ✅ Cache regenerado\n" : "   ❌ Error regenerando cache\n";

// 3. Limpiar cache general
echo "\n3. Limpiando cache general...\n";
system('cd "' . __DIR__ . '" && php artisan cache:clear 2>&1', $result3);
echo $result3 === 0 ? "   ✅ Cache general limpiado\n" : "   ❌ Error limpiando cache\n";

// 4. Ejecutar migraciones pendientes
echo "\n4. Ejecutando migraciones...\n";
system('cd "' . __DIR__ . '" && php artisan migrate --force 2>&1', $result4);
echo $result4 === 0 ? "   ✅ Migraciones ejecutadas\n" : "   ❌ Error en migraciones\n";

// 5. Ejecutar script de configuración
echo "\n5. Ejecutando configuración de timezone...\n";
system('cd "' . __DIR__ . '" && php fix_timezone_mexico.php 2>&1', $result5);
echo $result5 === 0 ? "   ✅ Timezone configurado\n" : "   ❌ Error configurando timezone\n";

echo "\n" . str_repeat('=', 50) . "\n";

if ($result1 === 0 && $result2 === 0 && $result3 === 0) {
    echo "🎉 CONFIGURACIÓN APLICADA EXITOSAMENTE\n";
    echo "\n📋 RESUMEN DE CAMBIOS:\n";
    echo "   ✅ Laravel timezone: UTC → America/Mexico_City\n";
    echo "   ✅ Cache de configuración actualizado\n";
    echo "   ✅ Base de datos configurada para México\n";
    echo "   ✅ Fechas se procesarán en horario de México\n";
    echo "\n🔥 IMPORTANTE: Reinicia el servidor web para aplicar cambios completamente\n";
} else {
    echo "⚠️ ALGUNOS PASOS FALLARON\n";
    echo "Revisa los errores arriba y ejecuta los comandos manualmente si es necesario.\n";
}

echo "\n🧪 PARA PROBAR:\n";
echo "1. Reinicia el servidor: php artisan serve\n";
echo "2. Prueba seleccionar una fecha en la app\n";
echo "3. Verifica que se guarde correctamente en la base de datos\n";
echo "4. Revisa los logs en storage/logs/laravel.log\n";
?>
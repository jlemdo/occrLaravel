@echo off
echo ================================
echo   OCCR FOOD DELIVERY - DEPLOYMENT TO HOSTINGER
echo ================================
echo.

echo [1/8] Validaciones de seguridad pre-deploy...
:: Verificar que no se está en modo debug en local
findstr "APP_DEBUG=true" .env > nul
if %errorlevel% equ 0 (
    echo ⚠️  ADVERTENCIA: Tu .env local tiene APP_DEBUG=true
    echo    Esto es normal para desarrollo local.
)

:: Verificar que composer.json existe
if not exist "composer.json" (
    echo ❌ ERROR: No se encuentra composer.json
    pause
    exit /b 1
)

echo ✅ Validaciones completadas

echo [2/8] Verificando assets...
:: Verificar si existe npm y si necesita build
if exist "package.json" (
    echo Proyecto tiene package.json - verificando si necesita build...
    if exist "public\build" (
        echo Assets ya compilados encontrados
    ) else (
        echo Intentando compilar assets con npm run build...
        call npm run build
        if %errorlevel% neq 0 (
            echo ⚠️  ADVERTENCIA: npm run build falló - usando assets estáticos existentes
            echo Proyecto funcionará con assets estáticos en public/
        )
    )
) else (
    echo Proyecto usa assets estáticos - no necesita compilación
)

echo [3/8] Limpiando cache de Laravel...
call php artisan config:clear
call php artisan cache:clear
call php artisan view:clear
call php artisan route:clear

echo [4/8] Optimizando para produccion...
call php artisan config:cache
call php artisan route:cache
call php artisan view:cache

echo [5/8] Creando estructura para hosting...
if not exist "deployment" mkdir deployment
if not exist "deployment\public_html" mkdir deployment\public_html

echo [6/8] Copiando archivos al directorio de deployment...

:: Copiar todo EXCEPTO vendor y archivos/carpetas específicas a la raiz
robocopy . deployment\ /E /XD vendor .git deployment .idea node_modules /XF .env .env.example *.bat *.md .gitignore

:: Copiar contenido de public a public_html (EXCLUIR archivo 'hot' de desarrollo)
robocopy public deployment\public_html\ /E /XF hot

:: LIMPIAR archivos de desarrollo que causan problemas con assets
echo Eliminando archivos de desarrollo de Vite y cache...
if exist "deployment\public_html\hot" del "deployment\public_html\hot"
if exist "deployment\bootstrap\cache\config.php" del "deployment\bootstrap\cache\config.php"
if exist "deployment\bootstrap\cache\routes-v7.php" del "deployment\bootstrap\cache\routes-v7.php"
if exist "deployment\bootstrap\cache\" rmdir /s /q "deployment\bootstrap\cache\"

:: Copiar index.php personalizado para Hostinger
if exist "public_html_index.php" (
    copy public_html_index.php deployment\public_html\index.php
    echo ✅ index.php personalizado copiado
) else (
    echo ⚠️  ADVERTENCIA: No se encontró public_html_index.php
)

:: Copiar .htaccess personalizado para Hostinger
if exist "public_html_htaccess.txt" (
    copy public_html_htaccess.txt deployment\public_html\.htaccess
    echo ✅ .htaccess personalizado copiado
) else (
    echo ⚠️  ADVERTENCIA: No se encontró public_html_htaccess.txt
)

:: MANEJO DE ASSETS - Tanto Vite como estáticos tradicionales
echo Manejando assets del proyecto...
if exist "public\build" (
    echo Copiando assets compilados de Vite...
    if exist "deployment\public_html\build" rmdir /s /q "deployment\public_html\build"
    robocopy public\build deployment\public_html\build /E
    
    :: Crear también en carpeta public para evitar errores de manifest
    if not exist "deployment\public" mkdir "deployment\public"
    if exist "deployment\public\build" rmdir /s /q "deployment\public\build"
    robocopy public\build deployment\public\build /E
    
    echo ✅ Assets de Vite copiados exitosamente
) else (
    echo Proyecto usa assets estáticos tradicionales - ya copiados con public/
)

:: Verificar que assets críticos estén presentes
if exist "deployment\public_html\assets" (
    echo ✅ Carpeta assets/ encontrada
) else (
    echo ⚠️  ADVERTENCIA: No se encontró carpeta assets/ - verificar estructura
)

if exist "deployment\public_html\vendors" (
    echo ✅ Carpeta vendors/ encontrada  
) else (
    echo ⚠️  ADVERTENCIA: No se encontró carpeta vendors/ - verificar dependencias
)

echo [7/8] Creando archivo .env optimizado para produccion...
(
    echo APP_NAME="OCCR Food Delivery"
    echo APP_ENV=production
    echo APP_KEY=base64:nAvruHIkJEUFZKF/5drDkRadh1qaUDS6IU2Nn5tRN7o=
    echo APP_DEBUG=false
    echo APP_URL=https://occr.pixelcrafters.digital
    echo.
    echo LOG_CHANNEL=single
    echo LOG_DEPRECATIONS_CHANNEL=null
    echo LOG_LEVEL=error
    echo.
    echo # Configuración de Base de Datos - COMPLETAR CON DATOS DE HOSTINGER
    echo DB_CONNECTION=mysql
    echo DB_HOST=localhost
    echo DB_PORT=3306
    echo DB_DATABASE=COMPLETAR_CON_BD_OCCR
    echo DB_USERNAME=COMPLETAR_CON_USER_BD
    echo DB_PASSWORD="COMPLETAR_CON_PASSWORD_BD"
    echo.
    echo BROADCAST_DRIVER=log
    echo CACHE_DRIVER=file
    echo FILESYSTEM_DISK=local
    echo QUEUE_CONNECTION=sync
    echo SESSION_DRIVER=file
    echo SESSION_LIFETIME=120
    echo.
    echo MEMCACHED_HOST=127.0.0.1
    echo.
    echo REDIS_HOST=127.0.0.1
    echo REDIS_PASSWORD=null
    echo REDIS_PORT=6379
    echo.
    echo # Configuración de Email - COMPLETAR CON DATOS DE HOSTINGER
    echo MAIL_MAILER=smtp
    echo MAIL_HOST=smtp.hostinger.com
    echo MAIL_PORT=587
    echo MAIL_USERNAME=COMPLETAR_CON_EMAIL@occr.pixelcrafters.digital
    echo MAIL_PASSWORD="COMPLETAR_CON_PASSWORD_EMAIL"
    echo MAIL_ENCRYPTION=tls
    echo MAIL_FROM_ADDRESS="COMPLETAR_CON_EMAIL@occr.pixelcrafters.digital"
    echo MAIL_FROM_NAME="OCCR Food Delivery"
    echo.
    echo PUSHER_APP_ID=
    echo PUSHER_APP_KEY=
    echo PUSHER_APP_SECRET=
    echo PUSHER_HOST=
    echo PUSHER_PORT=443
    echo PUSHER_SCHEME=https
    echo PUSHER_APP_CLUSTER=mt1
    echo.
    echo VITE_APP_NAME="OCCR Food Delivery"
    echo VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    echo VITE_PUSHER_HOST="${PUSHER_HOST}"
    echo VITE_PUSHER_PORT="${PUSHER_PORT}"
    echo VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
    echo VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    echo.
    echo # Stripe - Configuración de producción
    echo STRIPE_KEY=pk_live_51RUatHIhBUbZl3CrIf9BW6LjracnlDnVMnpeRkhIk2Th6ULOdgZiSL3oGnEkGR8h42aLnzyrHy80gGIjv6pzmTp800PbiPa4Pe
    echo STRIPE_SECRET=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
    echo HTTP_STRIPE_SIGNATURE=
    echo STRIPE_WEBHOOK_SECRET=whsec_JyCjfPfKQHXksa67toBcsUIGOdRgs6Gd
    echo.
    echo # Google OAuth - ACTUALIZAR REDIRECT URI
    echo GOOGLE_CLIENT_ID=COMPLETAR_DESPUES_DE_CONFIGURAR_GOOGLE_CONSOLE
    echo GOOGLE_CLIENT_SECRET=COMPLETAR_DESPUES_DE_CONFIGURAR_GOOGLE_CONSOLE
    echo GOOGLE_REDIRECT_URI=https://occr.pixelcrafters.digital/auth/google/callback
) > deployment\.env

echo [8/8] Comprimiendo deployment en ZIP...
:: Crear ZIP con fecha y hora
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set year=%datetime:~0,4%
set month=%datetime:~4,2%
set day=%datetime:~6,2%
set hour=%datetime:~8,2%
set minute=%datetime:~10,2%
set timestamp=%year%-%month%-%day%_%hour%-%minute%

:: Eliminar vendor de deployment antes de comprimir
echo Eliminando vendor para deployment ligero...
if exist "deployment\vendor" rmdir /s /q "deployment\vendor"

:: Crear ZIP
echo Comprimiendo archivos en occr-food-deployment-%timestamp%.zip...
powershell -Command "Compress-Archive -Path 'deployment\*' -DestinationPath 'occr-food-deployment-%timestamp%.zip' -Force"

if %errorlevel% equ 0 (
    echo ZIP creado exitosamente: occr-food-deployment-%timestamp%.zip
    dir "occr-food-deployment-%timestamp%.zip" | findstr "occr-food-deployment"
) else (
    echo ERROR: No se pudo crear el ZIP con PowerShell.
    echo Puedes comprimir la carpeta 'deployment' manualmente.
)

echo.
echo ================================
echo   DEPLOYMENT COMPLETADO!
echo ================================
echo.
echo ✅ Archivos preparados en: deployment\
echo ✅ ZIP listo: occr-food-deployment-%timestamp%.zip
echo ✅ .env configurado con datos de producción
echo ✅ Assets optimizados
echo.
echo 📋 PASOS POST-DEPLOY EN HOSTINGER:
echo.
echo 1. SUBIDA DE ARCHIVOS:
echo    - Sube el contenido de 'deployment\' a: /public_html/occr/
echo    - O extrae el ZIP directamente en: /public_html/occr/
echo.
echo 2. CONFIGURAR .env EN EL SERVIDOR:
echo    - Edita deployment/.env y completa:
echo      * DB_DATABASE, DB_USERNAME, DB_PASSWORD
echo      * MAIL_USERNAME, MAIL_PASSWORD
echo      * GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET (después)
echo.
echo 3. INSTALACION DE DEPENDENCIAS:
echo    composer install --no-dev --optimize-autoloader
echo.
echo 4. CONFIGURACION DE LARAVEL:
echo    php artisan key:generate --force
echo    php artisan migrate --force
echo    php artisan config:cache
echo    php artisan route:cache
echo    php artisan view:cache
echo.
echo 5. PERMISOS (importante):
echo    chmod 755 storage bootstrap/cache
echo    chmod -R 775 storage/logs storage/framework
echo.
echo 6. ENLACE SIMBOLICO (si es necesario):
echo    ln -s public_html public
echo.
echo ⚠️  RECORDATORIO DE SEGURIDAD:
echo    - APP_DEBUG=false en producción
echo    - Verificar que .env NO sea público
echo    - Configurar SSL/HTTPS
echo.
echo 🚀 URL de acceso: https://occr.pixelcrafters.digital
echo.
echo 📋 DESPUÉS DEL DEPLOY - FASE 4:
echo    1. Actualizar webhooks de Stripe
echo    2. Configurar Google OAuth redirect URIs
echo    3. Actualizar dominios autorizados en Firebase
echo    4. Testing completo frontend ←→ backend
echo.
pause
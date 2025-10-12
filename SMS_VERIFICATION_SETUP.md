# 📱 Sistema de Verificación por SMS con AWS SNS

Sistema profesional de verificación de teléfonos por SMS usando AWS SNS en Laravel.

---

## 📋 Tabla de Contenidos

1. [Características](#características)
2. [Configuración AWS](#configuración-aws)
3. [Configuración Laravel](#configuración-laravel)
4. [Uso de API](#uso-de-api)
5. [Testing](#testing)
6. [Costos](#costos)
7. [Troubleshooting](#troubleshooting)

---

## ✨ Características

- ✅ Envío de códigos OTP de 6 dígitos por SMS
- ✅ Validación automática de formato E.164
- ✅ Formateo automático de números mexicanos
- ✅ Límite de 3 intentos por hora
- ✅ Códigos expiran en 10 minutos
- ✅ Logs detallados de todos los envíos
- ✅ Modo debug en desarrollo
- ✅ Sistema on/off en settings

---

## 🔧 Configuración AWS

### Paso 1: Obtener Credenciales IAM

Tu usuario `jldev` ya tiene `AmazonSNSFullAccess`. Solo necesitas crear Access Keys:

**Opción A: Pedirle al administrador que cree las keys**

Envíale este mensaje:

> Hola, necesito Access Keys para mi usuario `jldev` para usar SNS desde Laravel.
>
> Pasos:
> 1. IAM → Users → jldev → Security credentials
> 2. Create access key → Application running outside AWS
> 3. Dame el Access Key ID y Secret Access Key

**Opción B: Asignar IAM Role a la instancia EC2 (recomendado para producción)**

1. IAM → Roles → Create role
2. AWS service → EC2
3. Attach policy: `AmazonSNSFullAccess`
4. Name: `occr-ec2-sns-role`
5. EC2 → Instances → tu instancia → Actions → Security → Modify IAM role
6. Assign: `occr-ec2-sns-role`

**Ventaja**: No necesitas guardar credenciales en el .env

---

### Paso 2: Configurar SNS Console

1. Ve a **AWS Console → SNS**
2. Click en **Text messaging (SMS)** en el menú lateral
3. Click en **Settings**
4. Configura:
   ```
   Default message type: Transactional
   Account spend limit: $10.00 USD
   Default sender ID: OCCR (opcional)
   ```

---

### Paso 3: Salir de SNS Sandbox (Producción)

Por defecto estás en **Sandbox** (solo números verificados).

Para enviar SMS a cualquier número:

1. SNS Console → Text messaging (SMS)
2. **Sandbox destination phone numbers**
3. Click **Request production access**
4. Llena el formulario:
   - **Use case**: Transactional (códigos OTP)
   - **Monthly SMS volume**: 1000-5000
   - **Description**: "Verificación de usuarios por SMS con códigos OTP"
5. **Tiempo de aprobación**: 24-48 horas

**Mientras tanto en Sandbox**: Puedes agregar números de prueba manualmente.

---

## ⚙️ Configuración Laravel

### Paso 1: Ejecutar Migración

```bash
php artisan migrate
```

Esto creará la tabla `phone_verifications`.

---

### Paso 2: Configurar .env

Agrega estas variables al `.env`:

```env
# AWS SNS Configuration
AWS_ACCESS_KEY_ID=AKIAIOSFODNN7EXAMPLE
AWS_SECRET_ACCESS_KEY=wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY
AWS_DEFAULT_REGION=us-east-2

# SMS Settings
SMS_ENABLED=true
SMS_SENDER_ID=OCCR
```

**Importante**:
- Reemplaza `your_access_key_id_here` con tu Access Key ID real
- Reemplaza `your_secret_access_key_here` con tu Secret Access Key real
- Region recomendada para México: `us-east-2` (Ohio)

---

### Paso 3: Activar en Settings

Agrega este registro a la tabla `settings`:

```sql
INSERT INTO settings (key, value, created_at, updated_at)
VALUES ('sms_verification_enabled', 'true', NOW(), NOW());
```

O usa el endpoint de toggle:

```bash
POST /api/settings/toggle-sms
{
    "enable": true
}
```

---

### Paso 4: Verificar Configuración

```bash
GET /api/sms/status
```

Respuesta esperada:
```json
{
    "sms_verification_enabled": true,
    "aws_sns_configured": true,
    "ready": true
}
```

---

## 🚀 Uso de API

### 1. Enviar Código OTP

**Endpoint**: `POST /api/sms/send`

**Body**:
```json
{
    "phone": "+521234567890",
    "type": "signup"
}
```

**Formatos de teléfono aceptados**:
- `+521234567890` (E.164 completo) ✅
- `1234567890` (10 dígitos, se agrega +52 automáticamente) ✅
- `521234567890` (12 dígitos, se agrega +) ✅

**Tipos disponibles**:
- `signup` - Registro de usuario
- `guest_checkout` - Checkout como invitado
- `profile_update` - Actualización de perfil
- `password_reset` - Reset de contraseña
- `guest_order` - Acceso a pedidos de invitado

**Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Código de verificación enviado por SMS",
    "sms_enabled": true,
    "phone": "+521234567890",
    "debug_otp": "123456"  // Solo en desarrollo
}
```

**Respuesta error**:
```json
{
    "success": false,
    "message": "Formato de teléfono inválido. Usa formato internacional (+521234567890)"
}
```

---

### 2. Verificar Código OTP

**Endpoint**: `POST /api/sms/verify`

**Body**:
```json
{
    "phone": "+521234567890",
    "otp": "123456",
    "type": "signup"
}
```

**Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Teléfono verificado correctamente",
    "sms_enabled": true
}
```

**Respuesta error**:
```json
{
    "success": false,
    "message": "Código OTP inválido o expirado"
}
```

---

### 3. Reenviar Código

**Endpoint**: `POST /api/sms/resend`

**Body**:
```json
{
    "phone": "+521234567890",
    "type": "signup"
}
```

**Límites**:
- Máximo 3 intentos por hora por teléfono
- Respuesta 429 si se excede el límite

**Respuesta límite excedido**:
```json
{
    "success": false,
    "message": "Has alcanzado el límite de intentos. Intenta nuevamente en 1 hora."
}
```

---

### 4. Verificar Estado del Servicio

**Endpoint**: `GET /api/sms/status`

**Respuesta**:
```json
{
    "sms_verification_enabled": true,
    "aws_sns_configured": true,
    "ready": true
}
```

---

## 🧪 Testing

### Modo Desarrollo

En modo `local`, el OTP se devuelve en la respuesta para facilitar testing:

```json
{
    "success": true,
    "message": "Código de verificación enviado por SMS",
    "debug_otp": "123456"  // ← Solo en desarrollo
}
```

**⚠️ Importante**: En producción (`APP_ENV=production`), `debug_otp` será `null`.

---

### Testing con Postman

1. **Enviar OTP**:
   ```
   POST http://localhost:8000/api/sms/send
   Content-Type: application/json

   {
       "phone": "5512345678",
       "type": "signup"
   }
   ```

2. **Copiar el código del campo `debug_otp`**

3. **Verificar OTP**:
   ```
   POST http://localhost:8000/api/sms/verify
   Content-Type: application/json

   {
       "phone": "+525512345678",
       "otp": "123456",
       "type": "signup"
   }
   ```

---

### Testing en SNS Sandbox

Si estás en Sandbox, primero agrega tu número de prueba:

1. SNS Console → Text messaging (SMS) → Sandbox
2. **Add phone number**
3. Ingresa tu número: `+521234567890`
4. Recibirás un SMS de verificación de AWS
5. Ingresa el código para verificar
6. Ahora puedes recibir SMS de tu aplicación

---

## 💰 Costos de AWS SNS

### Precios en México (Región: us-east-2)

| Tipo de SMS | Costo por SMS |
|-------------|---------------|
| Transaccional | $0.00645 USD |
| Promocional | $0.00405 USD |

### Estimación de Costos Mensuales

| Usuarios/mes | SMS enviados | Costo aproximado |
|--------------|--------------|------------------|
| 100 | 200 | $1.29 USD |
| 500 | 1,000 | $6.45 USD |
| 1,000 | 2,000 | $12.90 USD |
| 5,000 | 10,000 | $64.50 USD |

**Notas**:
- Los precios varían por país
- No hay cargos fijos mensuales
- Solo pagas por SMS enviados
- Transaccional es más caro pero tiene mejor deliverability

---

## 🐛 Troubleshooting

### Error: "SMS service is disabled"

**Causa**: `SMS_ENABLED=false` en el .env

**Solución**:
```env
SMS_ENABLED=true
```

Reinicia el servidor:
```bash
php artisan config:clear
```

---

### Error: "Invalid phone number format"

**Causa**: Número no está en formato E.164

**Solución**: Asegúrate de usar:
- `+521234567890` (con +52 para México)
- O deja que el sistema formatee automáticamente: `1234567890`

---

### Error: AWS credentials not found

**Causa**: Variables AWS no configuradas en .env

**Solución**: Verifica que tengas:
```env
AWS_ACCESS_KEY_ID=tu_key_aqui
AWS_SECRET_ACCESS_KEY=tu_secret_aqui
AWS_DEFAULT_REGION=us-east-2
```

---

### Error: SNS Sandbox - Can't send to this number

**Causa**: Estás en SNS Sandbox y el número no está verificado

**Soluciones**:
1. **Inmediata**: Agrega el número manualmente en SNS Console → Sandbox
2. **Definitiva**: Solicita salida de Sandbox (24-48 horas)

---

### SMS no llega

**Pasos de diagnóstico**:

1. **Verifica logs de Laravel**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Verifica SNS CloudWatch**:
   - AWS Console → CloudWatch → Logs
   - Log group: `/aws/sns/`

3. **Revisa formato del número**:
   ```json
   {
       "phone": "+521234567890"  // ✅ Correcto
       "phone": "1234567890"     // ✅ Se formatea automático
       "phone": "12-3456-7890"   // ❌ No usar guiones
   }
   ```

4. **Verifica límite de gasto**:
   - SNS Console → Text messaging → Settings
   - Account spend limit

---

### Demasiados intentos

**Error**: `429 - Has alcanzado el límite de intentos`

**Causa**: Más de 3 intentos en 1 hora

**Solución**:
- Esperar 1 hora, o
- Limpiar manualmente la tabla:
  ```sql
  DELETE FROM phone_verifications
  WHERE phone = '+521234567890'
  AND created_at < NOW() - INTERVAL 1 HOUR;
  ```

---

## 📊 Logs y Monitoreo

### Logs de Laravel

Todos los eventos se registran en `storage/logs/laravel.log`:

```
[2025-10-12 10:30:00] INFO: OTP SMS enviado exitosamente
    phone: +521234567890
    type: signup
    message_id: abc123-def456

[2025-10-12 10:31:00] INFO: Teléfono verificado exitosamente
    phone: +521234567890
    type: signup
```

### Logs de AWS

En CloudWatch puedes ver:
- Mensajes entregados exitosamente
- Mensajes fallidos y razón
- Costos por mensaje

---

## 🔐 Seguridad

### Mejores Prácticas

1. **Nunca exponer OTP en producción**:
   ```php
   'debug_otp' => app()->environment('local') ? $otp : null
   ```

2. **Limitar intentos por IP**:
   - Implementado: 3 intentos por hora por teléfono
   - Considera agregar límite por IP

3. **Códigos expiran en 10 minutos**:
   ```php
   'expires_at' => Carbon::now()->addMinutes(10)
   ```

4. **Proteger endpoints sensibles**:
   ```php
   Route::middleware('throttle:6,1')->group(function () {
       Route::post('/sms/send', ...);
   });
   ```

5. **No guardar credenciales AWS en código**:
   - Siempre usar .env
   - O usar IAM Roles en EC2

---

## 🚀 Deployment a Producción

### Checklist

- [ ] Obtener Access Keys de IAM
- [ ] Solicitar salida de SNS Sandbox (24-48h)
- [ ] Configurar .env en servidor:
  ```env
  SMS_ENABLED=true
  AWS_ACCESS_KEY_ID=...
  AWS_SECRET_ACCESS_KEY=...
  AWS_DEFAULT_REGION=us-east-2
  ```
- [ ] Ejecutar migración:
  ```bash
  php artisan migrate --force
  ```
- [ ] Activar en settings:
  ```sql
  INSERT INTO settings (key, value) VALUES ('sms_verification_enabled', 'true');
  ```
- [ ] Configurar límite de gasto en SNS
- [ ] Verificar logs funcionan correctamente
- [ ] Testing con números reales
- [ ] Monitorear costos en AWS Billing

---

## 📞 Soporte

**Archivos clave**:
- Migración: `database/migrations/2025_10_12_000001_create_phone_verifications_table.php`
- Servicio: `app/Services/SMSService.php`
- Controlador: `app/Http/Controllers/SMSVerificationController.php`
- Rutas: `routes/api.php` (líneas 166-170)
- Config: `config/services.php`

**Documentación AWS**:
- [SNS SMS Documentation](https://docs.aws.amazon.com/sns/latest/dg/sns-mobile-phone-number-as-subscriber.html)
- [SNS Pricing](https://aws.amazon.com/sns/pricing/)

---

## ✅ Sistema Listo

El sistema está completamente implementado. Solo necesitas:

1. **Obtener las Access Keys de tu usuario `jldev`**
2. **Agregarlas al .env**
3. **Ejecutar la migración**
4. **Activar SMS en settings**
5. **¡Listo para usar!**

---

Creado: 2025-10-12
Última actualización: 2025-10-12

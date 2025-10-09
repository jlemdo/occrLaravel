@extends('emails.layout')

@section('title', 'Verificación de Email - OCCR Productos')

@section('content')
<h2 class="content-title">🔐 Verifica tu Email</h2>
<p class="content-subtitle">
    Hemos enviado un código de seguridad para verificar tu email
</p>

<p class="content-text">
    Hola,<br><br>
    Para completar {{ $actionDescription ?? 'tu solicitud' }}, necesitamos verificar que esta dirección de email te pertenece.
</p>

<div class="otp-container">
    <p class="otp-label">Tu código de verificación:</p>
    <p class="otp-code">{{ $otpCode }}</p>
    <p class="otp-timer">⏰ Este código expira en 10 minutos</p>
</div>

<div class="info-box">
    <p class="info-box-title">📱 ¿Cómo usar el código?</p>
    <p class="info-box-text">
        1. Regresa a la app de OCCR Productos<br>
        2. Ingresa este código de 6 dígitos<br>
        3. ¡Listo! Tu email estará verificado
    </p>
</div>

@if(isset($userType) && $userType === 'guest')
<div class="warning-box">
    <span class="warning-icon">⚠️</span>
    <strong>Como usuario Guest:</strong> Tu información se guardará temporalmente. 
    Te recomendamos crear una cuenta para acceder a más beneficios.
</div>
@endif

<p class="content-text" style="margin-top: 24px;">
    <strong>¿No solicitaste este código?</strong><br>
    Si no realizaste esta acción, puedes ignorar este email. Tu cuenta permanece segura.
</p>

<div class="info-box" style="margin-top: 24px;">
    <p class="info-box-title">🛡️ Tu seguridad es importante</p>
    <p class="info-box-text">
        • Nunca compartas este código con terceros<br>
        • OCCR Productos nunca te pedirá el código por teléfono<br>
        • Este código solo es válido por 10 minutos
    </p>
</div>

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Tienes problemas? Contáctanos por WhatsApp: <br>
        <strong style="color: #D27F27;">+52 55 1234 5678</strong>
    </p>
</div>
@endsection
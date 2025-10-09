@extends('emails.layout')

@section('title', 'Restablecer Contraseña - OCCR Productos')

@section('content')
<h2 class="content-title">🔐 Restablece tu Contraseña</h2>
<p class="content-subtitle">
    Solicitud para cambiar tu contraseña
</p>

<p class="content-text">
    Hola <strong>{{ $userName ?? 'Cliente' }}</strong>,<br><br>
    Recibimos una solicitud para restablecer la contraseña de tu cuenta en OCCR Productos.
</p>

@if(isset($resetCode))
<!-- Código OTP para reset -->
<div class="otp-container">
    <p class="otp-label">Tu código de verificación:</p>
    <p class="otp-code">{{ $resetCode }}</p>
    <p class="otp-timer">⏰ Este código expira en 15 minutos</p>
</div>

<div class="info-box">
    <p class="info-box-title">📱 Pasos para restablecer:</p>
    <p class="info-box-text">
        1. Regresa a la app de OCCR Productos<br>
        2. Ingresa este código de 6 dígitos<br>
        3. Crea tu nueva contraseña<br>
        4. ¡Listo! Ya puedes acceder con tu nueva contraseña
    </p>
</div>
@else
<!-- Link tradicional para reset -->
<div class="button-container">
    <a href="{{ $resetLink ?? '#' }}" class="email-button">🔑 Crear Nueva Contraseña</a>
</div>

<p class="content-text" style="font-size: 14px; color: #666666;">
    Si no puedes hacer clic en el botón, copia y pega este enlace en tu navegador:<br>
    <span style="word-break: break-all; color: #D27F27;">{{ $resetLink ?? '#' }}</span>
</p>
@endif

<div class="warning-box">
    <span class="warning-icon">🛡️</span>
    <strong>Por tu seguridad:</strong> Si no solicitaste este cambio, ignora este email. 
    Tu contraseña actual seguirá siendo válida.
</div>

<div class="info-box" style="margin-top: 24px;">
    <p class="info-box-title">🔒 Consejos para una contraseña segura:</p>
    <p class="info-box-text">
        • Usa al menos 8 caracteres<br>
        • Combina letras, números y símbolos<br>
        • No uses información personal<br>
        • No compartas tu contraseña con nadie
    </p>
</div>

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Necesitas ayuda? Contáctanos<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
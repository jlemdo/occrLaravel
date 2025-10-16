@extends('emails.layout')

@section('title', 'Nueva Contraseña Temporal - OCCR Productos')

@section('content')
<h2 class="content-title">🔑 Nueva Contraseña Temporal</h2>
<p class="content-subtitle">Hemos generado una contraseña temporal para tu cuenta</p>

<p class="content-text">
    Hola <strong>{{ $user->name }}</strong>,
</p>

<p class="content-text">
    Recibimos una solicitud para restablecer la contraseña de tu cuenta en OCCR Productos. 
    Hemos generado una contraseña temporal que puedes usar para acceder a tu cuenta.
</p>

<!-- Contraseña Temporal Box -->
<div class="otp-container">
    <p class="otp-label">Tu contraseña temporal es:</p>
    <p class="otp-code" id="tempPassword" style="user-select: all; -webkit-user-select: all; -moz-user-select: all;">{{ $temporaryPassword }}</p>
    <p class="otp-timer">⏰ Válida inmediatamente</p>

    <!-- Botón para copiar contraseña -->
    <div style="text-align: center; margin-top: 16px;">
        <button onclick="copyPassword()" style="background: #D27F27; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-family: 'Segoe UI', Arial, sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            📋 Copiar Contraseña
        </button>
        <p id="copyMessage" style="color: #28a745; font-size: 12px; margin-top: 8px; opacity: 0; transition: opacity 0.3s;">✓ Contraseña copiada</p>
    </div>
</div>

<script>
function copyPassword() {
    // Obtener el texto de la contraseña
    var password = document.getElementById('tempPassword').innerText;

    // Crear elemento temporal para copiar
    var tempInput = document.createElement('input');
    tempInput.value = password;
    document.body.appendChild(tempInput);
    tempInput.select();

    try {
        // Copiar al portapapeles
        document.execCommand('copy');

        // Mostrar mensaje de confirmación
        var message = document.getElementById('copyMessage');
        message.style.opacity = '1';

        // Ocultar mensaje después de 3 segundos
        setTimeout(function() {
            message.style.opacity = '0';
        }, 3000);
    } catch (err) {
        console.error('Error al copiar:', err);
    }

    // Eliminar elemento temporal
    document.body.removeChild(tempInput);
}
</script>

<div class="info-box">
    <p class="info-box-title">📋 Instrucciones:</p>
    <div class="info-box-text">
        <strong>1.</strong> Abre la aplicación FAMAC<br>
        <strong>2.</strong> Inicia sesión con tu email y esta contraseña temporal<br>
        <strong>3.</strong> Ve a tu perfil y cambia la contraseña por una nueva
    </div>
</div>

<div class="warning-box">
    <p><span class="warning-icon">⚠️</span> 
    <strong>Por tu seguridad:</strong> Te recomendamos cambiar esta contraseña temporal 
    por una nueva después de iniciar sesión.</p>
</div>

<p class="content-text">
    Si no solicitaste este cambio, contacta a nuestro equipo de soporte inmediatamente.
</p>

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Necesitas ayuda? Contáctanos<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>

<p class="content-text" style="font-size: 13px; color: #666666; margin-top: 24px;">
    Este email fue enviado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }} hrs.
</p>
@endsection
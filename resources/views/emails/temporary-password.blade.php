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
    <p class="otp-code">{{ $temporaryPassword }}</p>
    <p class="otp-timer">⏰ Válida inmediatamente</p>
</div>

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

<div class="button-container">
    <a href="#" class="email-button">Abrir App FAMAC</a>
</div>

<p class="content-text" style="font-size: 13px; color: #666666; margin-top: 24px;">
    Este email fue enviado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }} hrs.
</p>
@endsection
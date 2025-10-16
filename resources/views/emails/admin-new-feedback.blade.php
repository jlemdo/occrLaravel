@extends('emails.layout')

@section('title', '💬 Nuevo Mensaje de Cliente - OCCR Admin')

@section('content')
<h2 class="content-title">💬 Nuevo Mensaje Recibido</h2>
<p class="content-subtitle">
    Un cliente ha enviado un mensaje de atención
</p>

<div class="otp-container" style="background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); border-color: #2196F3;">
    <p class="otp-label">Tipo de Mensaje:</p>
    <p class="otp-code" style="color: #1976D2; font-size: 24px;">
        @if(isset($senderType))
            @if($senderType === 'driver')
                🚚 Driver
            @else
                👤 Cliente
            @endif
        @else
            👤 Cliente
        @endif
    </p>
    <p class="otp-timer">📅 {{ now()->format('d/m/Y H:i') }}</p>
</div>

<div class="info-box">
    <p class="info-box-title">
        @if(isset($senderType) && $senderType === 'driver')
            🚚 Información del Driver
        @else
            👤 Información del Cliente
        @endif
    </p>
    <p class="info-box-text">
        <strong>Nombre:</strong> {{ $senderName ?? 'No especificado' }}<br>
        <strong>Email:</strong> {{ $senderEmail ?? 'No especificado' }}<br>
        @if(isset($senderPhone))
        <strong>Teléfono:</strong> {{ $senderPhone }}<br>
        @endif
        @if(isset($userType))
        <strong>Tipo:</strong> {{ $userType === 'Guest' ? '🔓 Guest' : '✅ Registrado' }}
        @endif
    </p>
</div>

@if(isset($orderNumber))
<div class="info-box">
    <p class="info-box-title">📦 Pedido Relacionado</p>
    <p class="info-box-text">
        <strong>Pedido:</strong> #{{ $orderNumber }}<br>
        @if(isset($orderStatus))
        <strong>Estado:</strong> {{ $orderStatus }}<br>
        @endif
        @if(isset($orderDate))
        <strong>Fecha:</strong> {{ $orderDate }}
        @endif
    </p>
</div>
@endif

<div class="order-details" style="background: #FFF; border: 2px solid #2196F3; padding: 20px; border-radius: 8px; margin: 24px 0;">
    <h3 style="margin: 0 0 12px 0; color: #1976D2; font-size: 16px;">💬 Mensaje del {{ isset($senderType) && $senderType === 'driver' ? 'Driver' : 'Cliente' }}:</h3>
    <p style="margin: 0; padding: 16px; background: #F5F5F5; border-radius: 8px; font-size: 15px; line-height: 1.6; color: #2F2F2F; white-space: pre-wrap;">{{ $message ?? 'Sin mensaje' }}</p>
</div>

@if(isset($category) || isset($priority))
<div class="info-box">
    <p class="info-box-title">🏷️ Clasificación</p>
    <p class="info-box-text">
        @if(isset($category))
        <strong>Categoría:</strong> {{ $category }}<br>
        @endif
        @if(isset($priority))
        <strong>Prioridad:</strong>
            @if($priority === 'high')
                <span style="color: #E63946;">🔴 Alta</span>
            @elseif($priority === 'medium')
                <span style="color: #ffc107;">🟡 Media</span>
            @else
                <span style="color: #28a745;">🟢 Normal</span>
            @endif
        @endif
    </p>
</div>
@endif

<div class="warning-box" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFEAA7 100%); border-color: #FF9800;">
    <span class="warning-icon">⚡</span>
    <strong>Acción Requerida:</strong>
    Contactar al {{ isset($senderType) && $senderType === 'driver' ? 'driver' : 'cliente' }} lo antes posible para resolver su consulta o problema.
    @if(isset($senderPhone))
    <br>Teléfono directo: <strong style="color: #D27F27;">{{ $senderPhone }}</strong>
    @endif
</div>

@if(isset($adminPanelUrl))
<div style="text-align: center; margin-top: 32px; padding: 20px; background: #F2EFE4; border-radius: 8px;">
    <p style="font-size: 14px; color: #666666; margin: 0;">
        📱 <strong>Panel de Administración:</strong><br>
        <a href="{{ $adminPanelUrl }}" style="color: #D27F27; text-decoration: none; font-weight: 600;">
            Ver mensaje completo en el panel →
        </a>
    </p>
</div>
@endif

<div style="text-align: center; margin-top: 24px;">
    <p style="font-size: 14px; color: #666666;">
        💬 <strong>Responder por WhatsApp:</strong><br>
        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $senderPhone ?? '') }}" style="color: #28a745; text-decoration: none; font-weight: 600;">
            Abrir chat con {{ isset($senderType) && $senderType === 'driver' ? 'driver' : 'cliente' }} →
        </a>
    </p>
</div>

<p class="content-text" style="font-size: 12px; color: #999999; margin-top: 24px; text-align: center;">
    Este es un email automático generado por el sistema OCCR Productos<br>
    Enviado: {{ now()->format('d/m/Y H:i:s') }}
</p>
@endsection

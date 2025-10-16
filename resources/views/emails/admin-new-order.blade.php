@extends('emails.layout')

@section('title', '🆕 Nuevo Pedido Recibido - OCCR Admin')

@section('content')
<h2 class="content-title">🆕 Nuevo Pedido Recibido</h2>
<p class="content-subtitle">
    Un cliente acaba de realizar un pedido
</p>

<div class="otp-container" style="background: linear-gradient(135deg, #E8F5E8 0%, #F0F8F0 100%); border-color: #28a745;">
    <p class="otp-label">Pedido:</p>
    <p class="otp-code" style="color: #28a745; font-size: 28px;">#{{ $orderNumber ?? '000' }}</p>
    <p class="otp-timer">📅 {{ $orderDate ?? now()->format('d/m/Y H:i') }}</p>
</div>

<div class="info-box">
    <p class="info-box-title">👤 Información del Cliente</p>
    <p class="info-box-text">
        <strong>Nombre:</strong> {{ $customerName ?? 'No especificado' }}<br>
        <strong>Email:</strong> {{ $customerEmail ?? 'No especificado' }}<br>
        <strong>Teléfono:</strong> {{ $customerPhone ?? 'No especificado' }}<br>
        <strong>Tipo:</strong> {{ $userType === 'Guest' ? '🔓 Guest' : '✅ Registrado' }}
    </p>
</div>

<div class="info-box">
    <p class="info-box-title">🚚 Dirección de Entrega</p>
    <p class="info-box-text">
        {{ $deliveryAddress ?? 'No especificada' }}<br>
        @if(isset($deliveryDate))
        <strong>Fecha solicitada:</strong> {{ $deliveryDate }}<br>
        @endif
        @if(isset($deliveryTime))
        <strong>Horario:</strong> {{ $deliveryTime }}
        @endif
    </p>
</div>

@if(isset($orderItems) && count($orderItems) > 0)
<div class="order-details">
    <h3 style="margin-bottom: 16px; color: #2F2F2F; font-size: 16px;">📋 Productos Pedidos:</h3>
    @foreach($orderItems as $item)
    <div class="order-item">
        <span>{{ $item['name'] ?? 'Producto' }} <strong>x{{ $item['quantity'] ?? 1 }}</strong></span>
        <span style="color: #D27F27; font-family: monospace;">${{ number_format($item['price'] ?? 0, 2) }}</span>
    </div>
    @endforeach

    @if(isset($discount) && $discount > 0)
    <div class="order-item" style="color: #28a745;">
        <span>🎟️ Descuento aplicado</span>
        <span>-${{ number_format($discount, 2) }}</span>
    </div>
    @endif

    <div class="order-item" style="border-top: 2px solid #D27F27; padding-top: 12px; font-size: 18px;">
        <span><strong>Total:</strong></span>
        <span><strong>${{ number_format($total ?? 0, 2) }} MXN</strong></span>
    </div>
</div>
@endif

<div class="info-box">
    <p class="info-box-title">💳 Método de Pago</p>
    <p class="info-box-text">
        {{ $paymentMethod ?? 'No especificado' }}<br>
        <strong>Estado:</strong>
        @if(isset($paymentStatus))
            @if($paymentStatus === 'paid')
                <span style="color: #28a745;">✅ Pago Confirmado</span>
            @elseif($paymentStatus === 'pending')
                <span style="color: #ffc107;">⏳ Pago Pendiente</span>
            @else
                <span style="color: #666;">{{ $paymentStatus }}</span>
            @endif
        @else
            <span style="color: #666;">En proceso</span>
        @endif
    </p>
</div>

@if(isset($specialInstructions) && !empty($specialInstructions))
<div class="warning-box">
    <span class="warning-icon">📝</span>
    <strong>Instrucciones especiales:</strong> {{ $specialInstructions }}
</div>
@endif

<div class="info-box" style="margin-top: 24px; background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%); border-color: #FF9800;">
    <p class="info-box-title">⚡ Acción Requerida</p>
    <p class="info-box-text">
        • Revisar disponibilidad de productos<br>
        • Preparar el pedido para entrega<br>
        • Asignar driver si es necesario<br>
        • Contactar al cliente para confirmar
    </p>
</div>

<div style="text-align: center; margin-top: 32px; padding: 20px; background: #F2EFE4; border-radius: 8px;">
    <p style="font-size: 14px; color: #666666; margin: 0;">
        📱 <strong>Panel de Administración:</strong><br>
        <a href="{{ $adminPanelUrl ?? 'https://awsoccr.pixelcrafters.digital/admin' }}" style="color: #D27F27; text-decoration: none; font-weight: 600;">
            Ver pedido en el panel →
        </a>
    </p>
</div>

<p class="content-text" style="font-size: 12px; color: #999999; margin-top: 24px; text-align: center;">
    Este es un email automático generado por el sistema OCCR Productos<br>
    Enviado: {{ now()->format('d/m/Y H:i:s') }}
</p>
@endsection

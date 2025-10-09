@extends('emails.layout')

@section('title', 'Pedido Confirmado - OCCR Productos')

@section('content')
<h2 class="content-title">✅ ¡Pedido Confirmado!</h2>
<p class="content-subtitle">
    Gracias por tu compra en OCCR Productos
</p>

<p class="content-text">
    Hola <strong>{{ $customerName ?? 'Cliente' }}</strong>,<br><br>
    Tu pedido ha sido confirmado y está siendo preparado con el mayor cuidado.
</p>

<div class="info-box">
    <p class="info-box-title">📦 Detalles de tu Pedido #{{ $orderNumber ?? '000' }}</p>
    <p class="info-box-text">
        <strong>Fecha:</strong> {{ $orderDate ?? now()->format('d/m/Y H:i') }}<br>
        <strong>Estado:</strong> <span style="color: #28a745;">✅ Pago Confirmado</span>
    </p>
</div>

@if(isset($orderItems) && count($orderItems) > 0)
<div class="order-details">
    <h3 style="margin-bottom: 16px; color: #2F2F2F; font-size: 16px;">📋 Productos:</h3>
    @foreach($orderItems as $item)
    <div class="order-item">
        <span>{{ $item['name'] ?? 'Producto' }} x{{ $item['quantity'] ?? 1 }}</span>
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
    <p class="info-box-title">🚚 Información de Entrega</p>
    <p class="info-box-text">
        <strong>Dirección:</strong> {{ $deliveryAddress ?? 'No especificada' }}<br>
        <strong>Fecha estimada:</strong> {{ $deliveryDate ?? 'A confirmar' }}<br>
        <strong>Horario:</strong> {{ $deliveryTime ?? 'A confirmar' }}
    </p>
</div>

<!-- Botón removido - solo información informativa -->

@if(isset($paymentMethod))
<div class="info-box">
    <p class="info-box-title">💳 Método de Pago</p>
    <p class="info-box-text">
        {{ $paymentMethod }}
        @if(isset($paymentStatus) && $paymentStatus === 'confirmed')
            - <span style="color: #28a745;">✅ Pago Confirmado</span>
        @elseif(isset($paymentMethod) && strpos($paymentMethod, 'OXXO') !== false)
            - <span style="color: #D27F27;">⏳ Pago en tienda confirmado</span>
        @else
            - <span style="color: #28a745;">✅ Procesado</span>
        @endif
    </p>
</div>
@endif

<div class="warning-box" style="margin-top: 24px;">
    <span class="warning-icon">📞</span>
    <strong>Te contactaremos:</strong> Nuestro equipo te llamará para confirmar la entrega 
    y asegurar que recibas tus productos en el mejor estado.
</div>

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Necesitas ayuda con tu pedido?<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
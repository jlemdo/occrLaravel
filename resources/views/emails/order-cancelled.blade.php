@extends('emails.layout')

@section('title', 'Pedido Cancelado - OCCR Productos')

@section('content')
<h2 class="content-title">❌ Pedido Cancelado</h2>
<p class="content-subtitle">
    Tu pedido ha sido cancelado
</p>

<p class="content-text">
    Hola <strong>{{ $customerName ?? 'Cliente' }}</strong>,<br><br>
    Te informamos que tu pedido #<strong>{{ $orderNumber ?? '000' }}</strong> ha sido cancelado.
</p>

<div class="info-box">
    <p class="info-box-title">📦 Detalles de la Cancelación</p>
    <p class="info-box-text">
        <strong>Pedido:</strong> #{{ $orderNumber ?? '000' }}<br>
        <strong>Cancelado:</strong> {{ $cancelledAt ?? now()->format('d/m/Y H:i') }}<br>
        <strong>Motivo:</strong> {{ $cancellationReason ?? 'Por solicitud del cliente' }}<br>
        <strong>Estado:</strong> <span style="color: #dc3545;">❌ Cancelado</span>
    </p>
</div>

@if(isset($refundAmount) && $refundAmount > 0)
<div class="otp-container" style="background: linear-gradient(135deg, #E8F5E8 0%, #F0F8F0 100%); border-color: #28a745;">
    <p class="otp-label">💰 Reembolso Procesado:</p>
    <p class="otp-code" style="color: #28a745; font-size: 24px;">${{ number_format($refundAmount, 2) }} MXN</p>
    <p class="otp-timer">⏰ El dinero aparecerá en {{ $refundDays ?? '3-5' }} días hábiles</p>
</div>

<div class="info-box">
    <p class="info-box-title">🏦 Información del Reembolso</p>
    <p class="info-box-text">
        @if(isset($paymentMethod))
        <strong>Método original:</strong> {{ $paymentMethod }}<br>
        @endif
        <strong>Monto:</strong> ${{ number_format($refundAmount, 2) }} MXN<br>
        <strong>Tiempo estimado:</strong> {{ $refundDays ?? '3-5' }} días hábiles<br>
        <strong>Estado:</strong> <span style="color: #28a745;">✅ Procesado</span>
    </p>
</div>
@elseif(isset($paymentMethod) && strpos($paymentMethod, 'OXXO') !== false)
<div class="warning-box">
    <span class="warning-icon">🏪</span>
    <strong>Pago OXXO:</strong> Como tu pedido se canceló antes del pago, 
    no tienes que realizar ningún pago en OXXO. El código de referencia ya no es válido.
</div>
@endif

@if(isset($orderItems) && count($orderItems) > 0)
<div class="order-details">
    <h3 style="margin-bottom: 16px; color: #2F2F2F; font-size: 16px;">📋 Productos cancelados:</h3>
    @foreach($orderItems as $item)
    <div class="order-item">
        <span>{{ $item['name'] ?? 'Producto' }} x{{ $item['quantity'] ?? 1 }}</span>
        <span style="color: #dc3545;">❌ Cancelado</span>
    </div>
    @endforeach
</div>
@endif

<div class="info-box">
    <p class="info-box-title">🛒 ¿Quieres Intentar de Nuevo?</p>
    <p class="info-box-text">
        Lamentamos que no hayamos podido completar tu pedido. 
        Todos nuestros productos siguen disponibles y estaremos encantados de servirte.
    </p>
</div>

<!-- Botón removido - solo información informativa -->

<div class="warning-box" style="margin-top: 24px;">
    <span class="warning-icon">💬</span>
    <strong>¿Por qué se canceló?</strong> 
    @if(isset($cancellationReason))
        {{ $cancellationReason }}
    @else
        Si tienes dudas sobre la cancelación, no dudes en contactarnos.
    @endif
</div>

@if(isset($compensationOffer))
<div class="otp-container" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFEAA7 100%); border-color: #F39C12;">
    <p class="otp-label">🎁 Como Compensación:</p>
    <p style="font-size: 16px; color: #E67E22; font-weight: 600; margin: 0;">
        {{ $compensationOffer ?? '15% de descuento en tu próximo pedido' }}
    </p>
    @if(isset($compensationCode))
    <p style="font-size: 14px; color: #D35400; margin-top: 8px;">
        Código: <span style="font-family: monospace; background: #FFF; padding: 4px 8px; border-radius: 4px;">{{ $compensationCode }}</span>
    </p>
    @endif
</div>
@endif

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Tienes preguntas sobre la cancelación?<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
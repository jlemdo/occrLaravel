@extends('emails.layout')

@section('title', 'Completa tu Pago en OXXO - OCCR Productos')

@section('content')
<h2 class="content-title">🏪 Completa tu Pago en OXXO</h2>
<p class="content-subtitle">
    Tu pedido está reservado - Solo falta el pago
</p>

<p class="content-text">
    Hola <strong>{{ $customerName ?? 'Cliente' }}</strong>,<br><br>
    Tu pedido #<strong>{{ $orderNumber ?? '000' }}</strong> ha sido creado exitosamente y está reservado para ti.
</p>

<div class="warning-box">
    <span class="warning-icon">⏰</span>
    <strong>Importante:</strong> Tienes <strong>{{ $expirationHours ?? '72' }} horas</strong> para realizar el pago en cualquier tienda OXXO. 
    Después de este tiempo, tu pedido será cancelado automáticamente.
</div>

<div class="info-box">
    <p class="info-box-title">🏪 Cómo pagar en OXXO:</p>
    <p class="info-box-text">
        1. Lleva este email a cualquier tienda OXXO<br>
        2. Dile al cajero "Quiero hacer un pago de servicios"<br>
        3. Proporciona el código de referencia<br>
        4. Realiza el pago en efectivo<br>
        5. Guarda tu comprobante
    </p>
</div>

<div class="otp-container">
    <p class="otp-label">Código de Referencia OXXO:</p>
    <p class="otp-code" style="font-size: 24px;">{{ $oxxoReference ?? 'XXXXXXXXXXXX' }}</p>
    <p class="otp-timer">💰 Monto a pagar: <strong>${{ number_format($total ?? 0, 2) }} MXN</strong></p>
</div>

@if(isset($orderItems) && count($orderItems) > 0)
<div class="order-details">
    <h3 style="margin-bottom: 16px; color: #2F2F2F; font-size: 16px;">📋 Resumen de tu pedido:</h3>
    @foreach($orderItems as $item)
    <div class="order-item">
        <span>{{ $item['name'] ?? 'Producto' }} x{{ $item['quantity'] ?? 1 }}</span>
        <span style="color: #D27F27; font-family: monospace;">${{ number_format($item['price'] ?? 0, 2) }}</span>
    </div>
    @endforeach
    
    <div class="order-item" style="border-top: 2px solid #D27F27; padding-top: 12px; font-size: 18px;">
        <span><strong>Total a pagar:</strong></span>
        <span><strong>${{ number_format($total ?? 0, 2) }} MXN</strong></span>
    </div>
</div>
@endif

<div class="info-box">
    <p class="info-box-title">📅 Vence el:</p>
    <p class="info-box-text" style="font-size: 16px; color: #D27F27; font-weight: 600;">
        {{ $expirationDate ?? now()->addHours(72)->format('d/m/Y H:i') }}
    </p>
</div>

<!-- Botón removido - solo información informativa -->

<div class="info-box" style="margin-top: 24px;">
    <p class="info-box-title">✅ Después del pago:</p>
    <p class="info-box-text">
        • Tu pago se confirmará automáticamente en unos minutos<br>
        • Recibirás un email de confirmación<br>
        • Prepararemos tu pedido para entrega<br>
        • Te contactaremos para coordinar la entrega
    </p>
</div>

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Problemas con el pago? Contáctanos<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
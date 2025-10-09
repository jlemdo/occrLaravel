@extends('emails.layout')

@section('title', 'Pedido Entregado - OCCR Productos')

@section('content')
<h2 class="content-title">✅ ¡Pedido Entregado!</h2>
<p class="content-subtitle">
    Esperamos que disfrutes tus productos frescos
</p>

<p class="content-text">
    Hola <strong>{{ $customerName ?? 'Cliente' }}</strong>,<br><br>
    ¡Excelente! Tu pedido #<strong>{{ $orderNumber ?? '000' }}</strong> ha sido entregado exitosamente.
</p>

<div class="info-box">
    <p class="info-box-title">📦 Detalles de la Entrega</p>
    <p class="info-box-text">
        <strong>Pedido:</strong> #{{ $orderNumber ?? '000' }}<br>
        <strong>Entregado:</strong> {{ $deliveredAt ?? now()->format('d/m/Y H:i') }}<br>
        <strong>Recibido por:</strong> {{ $receivedBy ?? 'Cliente' }}<br>
        <strong>Estado:</strong> <span style="color: #28a745;">✅ Completado</span>
    </p>
</div>

@if(isset($deliveryPhoto))
<div class="info-box">
    <p class="info-box-title">📸 Foto de Entrega</p>
    <p class="info-box-text">
        Nuestro repartidor tomó una foto como comprobante de entrega segura.
    </p>
    <div style="text-align: center; margin-top: 12px;">
        <img src="{{ $deliveryPhoto }}" alt="Comprobante de entrega" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd;">
    </div>
</div>
@endif

<!-- Botón removido - solo información informativa -->

@if(isset($orderItems) && count($orderItems) > 0)
<div class="order-details">
    <h3 style="margin-bottom: 16px; color: #2F2F2F; font-size: 16px;">📋 Productos entregados:</h3>
    @foreach($orderItems as $item)
    <div class="order-item">
        <span>{{ $item['name'] ?? 'Producto' }} x{{ $item['quantity'] ?? 1 }}</span>
        <span style="color: #28a745;">✅ Entregado</span>
    </div>
    @endforeach
</div>
@endif

<div class="info-box">
    <p class="info-box-title">🥛 Cuidado de tus Lácteos</p>
    <p class="info-box-text">
        • Refrigera inmediatamente los productos lácteos<br>
        • Verifica las fechas de caducidad<br>
        • Consume antes de la fecha indicada<br>
        • Mantén la cadena de frío siempre
    </p>
</div>

<div class="warning-box">
    <span class="warning-icon">🔄</span>
    <strong>¿Te gustó tu experiencia?</strong> Realiza tu próximo pedido y obtén 
    <span style="color: #D27F27; font-weight: 600;">5% de descuento</span> con el código: 
    <span style="background: #F2EFE4; padding: 4px 8px; border-radius: 4px; font-family: monospace; color: #D27F27; font-weight: 600;">FIEL5</span>
</div>

<div class="info-box" style="margin-top: 24px;">
    <p class="info-box-title">❓ ¿Algún Problema?</p>
    <p class="info-box-text">
        Si tienes algún inconveniente con tu pedido, contáctanos dentro de las próximas 2 horas 
        y lo resolveremos inmediatamente.
    </p>
</div>

<!-- Botón removido - solo información informativa -->

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¡Gracias por confiar en OCCR Productos!<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
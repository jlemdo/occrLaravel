@extends('emails.layout')

@section('title', 'Tu Pedido Está En Camino - OCCR Productos')

@section('content')
<h2 class="content-title">🚚 ¡Tu Pedido Está En Camino!</h2>
<p class="content-subtitle">
    Tus productos frescos van hacia ti
</p>

<p class="content-text">
    Hola <strong>{{ $customerName ?? 'Cliente' }}</strong>,<br><br>
    ¡Excelentes noticias! Tu pedido #<strong>{{ $orderNumber ?? '000' }}</strong> ha salido de nuestras instalaciones y está en camino a tu domicilio.
</p>

<div class="info-box">
    <p class="info-box-title">📦 Estado del Envío</p>
    <p class="info-box-text">
        <strong>Pedido:</strong> #{{ $orderNumber ?? '000' }}<br>
        <strong>Estado:</strong> <span style="color: #D27F27;">🚚 En Tránsito</span><br>
        <strong>Salió:</strong> {{ $shippedAt ?? now()->format('d/m/Y H:i') }}
    </p>
</div>

@if(isset($trackingNumber))
<div class="otp-container" style="background: linear-gradient(135deg, #E3F2FD 0%, #F3E5F5 100%); border-color: #2196F3;">
    <p class="otp-label">Número de Seguimiento:</p>
    <p class="otp-code" style="color: #2196F3; font-size: 20px;">{{ $trackingNumber }}</p>
</div>

<!-- Botón removido - solo información informativa -->
@endif

<div class="info-box">
    <p class="info-box-title">🏠 Información de Entrega</p>
    <p class="info-box-text">
        <strong>Dirección:</strong> {{ $deliveryAddress ?? 'No especificada' }}<br>
        <strong>Fecha estimada:</strong> {{ $estimatedDelivery ?? 'Hoy' }}<br>
        <strong>Horario:</strong> {{ $deliveryWindow ?? '9:00 AM - 6:00 PM' }}
    </p>
</div>

@if(isset($driverInfo))
<div class="info-box">
    <p class="info-box-title">👨‍🚚 Tu Repartidor</p>
    <p class="info-box-text">
        <strong>Nombre:</strong> {{ $driverInfo['name'] ?? 'Por asignar' }}<br>
        @if(isset($driverInfo['phone']))
        <strong>Teléfono:</strong> <span style="color: #D27F27;">{{ $driverInfo['phone'] }}</span><br>
        @endif
        @if(isset($driverInfo['vehicle']))
        <strong>Vehículo:</strong> {{ $driverInfo['vehicle'] }}
        @endif
    </p>
</div>
@endif

<div class="warning-box">
    <span class="warning-icon">📱</span>
    <strong>Te contactaremos:</strong> Nuestro repartidor te llamará cuando esté cerca de tu domicilio 
    para coordinar la entrega perfecta.
</div>

<div class="info-box" style="margin-top: 24px;">
    <p class="info-box-title">🥛 Cuidado de tus Lácteos</p>
    <p class="info-box-text">
        • Todos los productos van en refrigeración<br>
        • Empaque térmico para mantener la frescura<br>
        • Entrega directa en tus manos<br>
        • Verifica la fecha de caducidad al recibir
    </p>
</div>

@if(isset($orderItems) && count($orderItems) > 0)
<div class="order-details">
    <h3 style="margin-bottom: 16px; color: #2F2F2F; font-size: 16px;">📋 Productos en camino:</h3>
    @foreach($orderItems as $item)
    <div class="order-item">
        <span>{{ $item['name'] ?? 'Producto' }} x{{ $item['quantity'] ?? 1 }}</span>
        <span style="color: #28a745;">✅ En camino</span>
    </div>
    @endforeach
</div>
@endif

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Problemas con la entrega?<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
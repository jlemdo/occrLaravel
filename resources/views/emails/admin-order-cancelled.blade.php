@extends('emails.layout')

@section('title', '❌ Pedido Cancelado - OCCR Admin')

@section('content')
<h2 class="content-title">❌ Pedido Cancelado</h2>
<p class="content-subtitle">
    Un pedido ha sido cancelado
</p>

<div class="otp-container" style="background: linear-gradient(135deg, #FFE8E8 0%, #FFF0F0 100%); border-color: #dc3545;">
    <p class="otp-label">Pedido Cancelado:</p>
    <p class="otp-code" style="color: #dc3545; font-size: 28px;">#{{ $orderNumber ?? '000' }}</p>
    <p class="otp-timer">📅 {{ $cancelledAt ?? now()->format('d/m/Y H:i') }}</p>
</div>

<div class="warning-box" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFEAA7 100%); border-color: #F39C12;">
    <span class="warning-icon">⚠️</span>
    <strong>Cancelado por:</strong>
    @if($cancelledBy === 'customer')
        <span style="color: #E67E22;">👤 Cliente</span>
    @elseif($cancelledBy === 'driver')
        <span style="color: #E67E22;">🚚 Driver</span>
    @else
        <span style="color: #E67E22;">👨‍💼 Admin</span>
    @endif
</div>

<div class="info-box">
    <p class="info-box-title">📝 Motivo de Cancelación</p>
    <p class="info-box-text" style="color: #dc3545; font-weight: 500;">
        {{ $reason ?? 'No se proporcionó motivo' }}
    </p>
</div>

<div class="info-box">
    <p class="info-box-title">👤 Información del Cliente</p>
    <p class="info-box-text">
        <strong>Nombre:</strong> {{ $customerName ?? 'No especificado' }}<br>
        <strong>Email:</strong> {{ $customerEmail ?? 'No especificado' }}<br>
    </p>
</div>

<div class="info-box">
    <p class="info-box-title">🚚 Dirección de Entrega</p>
    <p class="info-box-text">
        {{ $deliveryAddress ?? 'No especificada' }}
    </p>
</div>

<div class="info-box">
    <p class="info-box-title">💰 Monto del Pedido Cancelado</p>
    <p class="info-box-text">
        <strong style="font-size: 20px; color: #dc3545;">${{ number_format($total ?? 0, 2) }} MXN</strong>
    </p>
</div>

<div class="info-box" style="margin-top: 24px; background: linear-gradient(135deg, #E8F5E8 0%, #F0F8F0 100%); border-color: #28a745;">
    <p class="info-box-title">✅ Acciones Recomendadas</p>
    <p class="info-box-text">
        • Revisar motivo de cancelación<br>
        @if($cancelledBy === 'customer')
        • Contactar al cliente si es necesario<br>
        • Revisar si hubo problema con el producto/servicio<br>
        @elseif($cancelledBy === 'driver')
        • Contactar al driver para más detalles<br>
        • Revisar si necesita soporte<br>
        @endif
        • Verificar si requiere reembolso<br>
        • Devolver productos al inventario si ya fueron separados
    </p>
</div>

<div style="text-align: center; margin-top: 32px; padding: 20px; background: #F2EFE4; border-radius: 8px;">
    <p style="font-size: 14px; color: #666666; margin: 0;">
        📱 <strong>Panel de Administración:</strong><br>
        <a href="{{ $adminPanelUrl ?? 'https://awsoccr.pixelcrafters.digital/admin' }}" style="color: #D27F27; text-decoration: none; font-weight: 600;">
            Ver detalles del pedido →
        </a>
    </p>
</div>

<p class="content-text" style="font-size: 12px; color: #999999; margin-top: 24px; text-align: center;">
    Este es un email automático generado por el sistema OCCR Productos<br>
    Enviado: {{ now()->format('d/m/Y H:i:s') }}
</p>
@endsection

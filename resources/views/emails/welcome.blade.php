@extends('emails.layout')

@section('title', 'Bienvenido a OCCR Productos')

@section('content')
<h2 class="content-title">🎉 ¡Bienvenido a OCCR Productos!</h2>
<p class="content-subtitle">
    Tu tienda de lácteos de confianza
</p>

<p class="content-text">
    Hola <strong>{{ $userName ?? 'Cliente' }}</strong>,<br><br>
    ¡Gracias por unirte a la familia OCCR Productos! Estamos emocionados de tenerte con nosotros.
</p>

<div class="info-box">
    <p class="info-box-title">🥛 ¿Qué encontrarás en OCCR Productos?</p>
    <p class="info-box-text">
        • Lácteos frescos de la más alta calidad<br>
        • Entrega rápida y confiable a tu domicilio<br>
        • Precios justos y ofertas especiales<br>
        • Atención personalizada para cada cliente
    </p>
</div>

<!-- Botón removido - solo información informativa -->

<p class="content-text">
    <strong>Tu primera compra con descuento:</strong><br>
    Usa el código <span style="background: #F2EFE4; padding: 4px 8px; border-radius: 4px; font-family: monospace; color: #D27F27; font-weight: 600;">BIENVENIDO10</span> 
    y obtén 10% de descuento en tu primera orden.
</p>

<div class="info-box" style="margin-top: 24px;">
    <p class="info-box-title">📱 Descarga nuestra app</p>
    <p class="info-box-text">
        Para una experiencia más cómoda, descarga nuestra app móvil y realiza pedidos desde cualquier lugar.
    </p>
</div>

<div style="text-align: center; margin-top: 32px;">
    <p style="font-size: 14px; color: #666666;">
        ¿Tienes preguntas? Estamos aquí para ayudarte<br>
        <strong style="color: #D27F27;">WhatsApp: +52 55 1234 5678</strong>
    </p>
</div>
@endsection
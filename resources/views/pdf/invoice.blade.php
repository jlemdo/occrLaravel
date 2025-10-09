<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Compra #{{ $order->order_number ?? $order->id }}</title>
    <style>
        /* ======== RESET Y CONFIGURACIÓN BASE ======== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        @page {
            size: 80mm auto;
            margin: 5mm;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.2;
            background: #fff;
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;
        }

        /* ======== WRAPPER PRINCIPAL - ESTILO TICKET TÉRMICO ======== */
        .ticket-wrapper {
            width: 80mm;
            max-width: 80mm;
            margin: 0 auto;
            background: #fff;
            padding: 8px;
            border: none;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* ======== ENCABEZADO EMPRESARIAL ======== */
        .header { 
            text-align: center; 
            margin-bottom: 8px; 
            border-bottom: 1px dashed #333; 
            padding-bottom: 6px; 
        }
        
        .logo-container {
            margin-bottom: 6px;
        }
        
        .header img { 
            width: 40px; 
            height: 40px; 
            object-fit: contain; 
            border-radius: 6px;
        }
        
        .company-name { 
            font-size: 14px; 
            color: #8B5E3C; 
            margin: 4px 0 2px 0; 
            font-weight: bold; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
        }
        
        .company-slogan {
            font-size: 9px;
            color: #D27F27;
            font-style: italic;
            margin-bottom: 4px;
        }
        
        .company-info { 
            color: #555; 
            font-size: 8px; 
            line-height: 1.3;
        }

        /* ======== INFORMACIÓN DE TICKET ======== */
        .ticket-type {
            background: #f8f9fa;
            text-align: center;
            padding: 4px;
            margin: 4px 0;
            border: 1px solid #dee2e6;
            border-radius: 3px;
            width: 100%;
            box-sizing: border-box;
        }
        
        .ticket-type h2 {
            font-size: 11px;
            color: #2c3e50;
            margin: 0;
            font-weight: bold;
        }

        /* ======== DATOS DE LA TRANSACCIÓN ======== */
        .transaction-info {
            margin: 6px 0;
            font-size: 9px;
            width: 100%;
            box-sizing: border-box;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
            border-bottom: 1px dotted #ddd;
            padding-bottom: 1px;
            width: 100%;
            box-sizing: border-box;
        }

        .info-label {
            font-weight: bold;
            color: #2c3e50;
            flex: 1;
        }

        .info-value {
            text-align: right;
            color: #333;
            flex: 1;
            word-wrap: break-word;
        }

        /* ======== INFORMACIÓN DEL CLIENTE ======== */
        .customer-section {
            margin: 8px 0;
            padding: 6px;
            background: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #e9ecef;
            width: 100%;
            box-sizing: border-box;
        }
        
        .customer-title {
            font-size: 12px;
            font-weight: bold;
            color: #8B5E3C;
            margin-bottom: 6px;
            text-align: center;
        }

        /* ======== DETALLES DE ENTREGA ======== */
        .delivery-section {
            margin: 8px 0;
            padding: 6px;
            background: #f0f8ff;
            border-radius: 4px;
            border: 1px solid #d1ecf1;
            width: 100%;
            box-sizing: border-box;
        }
        
        .delivery-title {
            font-size: 12px;
            font-weight: bold;
            color: #0c5460;
            margin-bottom: 6px;
            text-align: center;
        }

        /* ======== SEPARADOR ======== */
        .divider { 
            border-top: 2px dashed #2c3e50; 
            margin: 12px 0; 
        }

        /* ======== TABLA DE PRODUCTOS ======== */
        .items-section {
            margin: 8px 0;
            width: 100%;
            box-sizing: border-box;
        }

        .items-title {
            font-size: 11px;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 6px;
            background: #e9ecef;
            padding: 4px;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            table-layout: fixed;
        }

        .items td {
            padding: 3px 1px;
            border-bottom: 1px dotted #ddd;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .item-name {
            text-align: left;
            font-weight: 500;
            color: #2c3e50;
            width: 60%;
        }

        .item-details {
            font-size: 8px;
            color: #666;
        }

        .item-qty {
            text-align: center;
            font-weight: bold;
            width: 15%;
        }

        .item-price {
            text-align: right;
            font-family: 'Courier New', monospace;
            width: 25%;
        }

        /* ======== RESUMEN DE TOTALES ======== */
        .totals-section {
            margin: 10px 0;
            padding: 6px;
            background: #f8f9fa;
            border-radius: 4px;
            border: 2px solid #8B5E3C;
            width: 100%;
            box-sizing: border-box;
        }

        .totals {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            table-layout: fixed;
        }

        .totals td {
            padding: 3px 0;
            word-wrap: break-word;
        }
        
        .total-label { 
            text-align: left; 
            color: #2c3e50; 
            font-weight: 500;
        }
        
        .total-value { 
            text-align: right; 
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
        
        .subtotal-row {
            border-bottom: 1px dotted #ccc;
        }
        
        .tax-row {
            border-bottom: 1px dotted #ccc;
            color: #666;
        }
        
        .shipping-row {
            border-bottom: 1px dotted #ccc;
            color: #666;
        }
        
        .grand-total { 
            border-top: 2px solid #8B5E3C; 
            font-weight: bold; 
            font-size: 14px; 
            background-color: #8B5E3C;
            color: #fff;
        }
        
        .grand-total td { 
            padding: 8px 0; 
            font-weight: bold;
        }

        /* ======== INFORMACIÓN FISCAL ======== */
        .tax-info {
            margin: 8px 0;
            padding: 6px;
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            font-size: 9px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        /* ======== PIE DE PÁGINA ======== */
        .footer {
            text-align: center;
            margin-top: 8px;
            padding-top: 4px;
            border-top: 1px dashed #333;
            font-size: 7px;
            color: #666;
            width: 100%;
            box-sizing: border-box;
        }
        
        .footer-thanks {
            font-size: 10px;
            font-weight: bold;
            color: #8B5E3C;
            margin-bottom: 4px;
        }
        
        .footer-social {
            margin: 3px 0;
            font-style: italic;
        }
        
        .footer-legal {
            font-size: 7px;
            color: #888;
            margin-top: 4px;
        }

        /* ======== QR CODE SECTION ======== */
        .qr-section {
            text-align: center;
            margin: 8px 0;
            padding: 6px;
            background: #f8f9fa;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        
        .qr-title {
            font-size: 10px;
            color: #666;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
@php
    // Usar orderDetails pasados desde el controlador, con fallback
    $productDetails = $orderDetails ?? \DB::table('ordedetails')->where('orderno', $order->order_number ?? $order->id)->get();
    
    // Calcular subtotal real desde productos
    $subtotal = $productDetails->sum(function($item) {
        return $item->item_price * $item->item_qty;
    });
    
    // Aplicar descuento si existe
    $discount = $order->coupon_discount ?? 0;
    $subtotalAfterDiscount = $subtotal - $discount;
    
    // Cálculos para México - Sin IVA en productos básicos
    $shippingCost = round($order->shipping_cost ?? 0, 2);
    $grandTotal = round($subtotalAfterDiscount + $shippingCost, 2);
    
    // Formatear fecha y hora mexicanas
    $fechaMexicana = $order->created_at->setTimezone('America/Mexico_City');
@endphp

<div class="ticket-wrapper">
    <!-- ======== ENCABEZADO EMPRESARIAL ======== -->
    <div class="header">
        <div class="logo-container">
            <img src="{{ public_path('img/logoj.jpg') }}" alt="OCCR Productos Logo">
        </div>
        <div class="company-name">OCCR Productos</div>
        <div class="company-slogan">Lácteos y Más para tu Hogar</div>
        <div class="company-info">
            Ciudad de México, México<br>
            WhatsApp: +52 55 1234 5678<br>
            Email: contacto@occr.com<br>
            www.occr.pixelcrafters.digital
        </div>
    </div>

    <!-- ======== TIPO DE COMPROBANTE ======== -->
    <div class="ticket-type">
        <h2>TICKET DE COMPRA</h2>
    </div>

    <!-- ======== INFORMACIÓN DE LA TRANSACCIÓN ======== -->
    <div class="transaction-info">
        <div class="info-row">
            <span class="info-label">Folio:</span>
            <span class="info-value">{{ $order->order_number ?? $order->id }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Fecha:</span>
            <span class="info-value">{{ $fechaMexicana->format('d/m/Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Hora:</span>
            <span class="info-value">{{ $fechaMexicana->format('H:i:s') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Estado:</span>
            <span class="info-value">{{ $order->status_spanish ?? $order->status ?? 'Procesando' }}</span>
        </div>
    </div>

    <!-- ======== INFORMACIÓN DEL CLIENTE ======== -->
    <div class="customer-section">
        <div class="customer-title">DATOS DEL CLIENTE</div>
        <div class="info-row">
            <span class="info-label">Cliente:</span>
            <span class="info-value">
                @if($user && $user->first_name)
                    {{ $user->first_name }} {{ $user->last_name ?? '' }}
                @elseif($order->guest_name)
                    {{ $order->guest_name }}
                @else
                    Cliente Invitado
                @endif
            </span>
        </div>
        @if($order->user_email)
        <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value">{{ $order->user_email }}</span>
        </div>
        @endif
    </div>

    <!-- ======== DETALLES DE ENTREGA ======== -->
    @if($order->delivery_address || $order->delivery_date)
    <div class="delivery-section">
        <div class="delivery-title">INFORMACIÓN DE ENTREGA</div>
        @if($order->delivery_address)
        <div class="info-row">
            <span class="info-label">Dirección:</span>
            <span class="info-value" style="font-size: 10px;">{{ $order->delivery_address }}</span>
        </div>
        @endif
        @if($order->delivery_date)
        <div class="info-row">
            <span class="info-label">Fecha entrega:</span>
            <span class="info-value">{{ $order->delivery_date }}</span>
        </div>
        @endif
        @if($order->delivery_slot)
        <div class="info-row">
            <span class="info-label">Horario:</span>
            <span class="info-value">{{ $order->delivery_slot }}</span>
        </div>
        @endif
    </div>
    @endif

    <div class="divider"></div>

    <!-- ======== PRODUCTOS COMPRADOS ======== -->
    <div class="items-section">
        <div class="items-title">PRODUCTOS</div>
        <table class="items">
            <tbody>
                @foreach($productDetails as $item)
                <tr>
                    <td class="item-name">
                        <strong>{{ $item->item_name }}</strong>
                        <div class="item-details">
                            {{ $item->item_qty }} x ${{ number_format($item->item_price, 2) }}
                        </div>
                    </td>
                    <td class="item-qty">{{ $item->item_qty }}</td>
                    <td class="item-price">${{ number_format($item->item_qty * $item->item_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="divider"></div>

    <!-- ======== RESUMEN DE TOTALES ======== -->
    <div class="totals-section">
        <table class="totals">
            <tr class="subtotal-row">
                <td class="total-label">Subtotal:</td>
                <td class="total-value">${{ number_format($subtotal, 2) }}</td>
            </tr>
            @if($discount > 0)
            <tr class="tax-row">
                <td class="total-label">Descuento{{ $order->coupon_code ? ' (' . $order->coupon_code . ')' : '' }}:</td>
                <td class="total-value">-${{ number_format($discount, 2) }}</td>
            </tr>
            @endif
            @if($shippingCost > 0)
            <tr class="shipping-row">
                <td class="total-label">Envío:</td>
                <td class="total-value">${{ number_format($shippingCost, 2) }}</td>
            </tr>
            @endif
            <tr class="grand-total">
                <td class="total-label">TOTAL A PAGAR:</td>
                <td class="total-value">${{ number_format($grandTotal, 2) }} MXN</td>
            </tr>
        </table>
    </div>

    <!-- ======== INFORMACIÓN FISCAL MÉXICO ======== -->
    @if($order->need_invoice === 'true' && $order->tax_details)
    <div class="tax-info">
        <strong>INFORMACIÓN FISCAL</strong><br>
        RFC: {{ strtoupper($order->tax_details) }}<br>
        Régimen: Público en General<br>
        Este comprobante tiene validez fiscal<br>
        Conservar para aclaraciones
    </div>
    @else
    <div class="tax-info">
        <strong>COMPROBANTE DE COMPRA</strong><br>
        Ticket sin valor fiscal<br>
        Este comprobante ampara la recepción de productos<br>
        Conservar para aclaraciones
    </div>
    @endif

    <!-- ======== CÓDIGO QR PARA FACTURACIÓN ======== -->
    @if($order->need_invoice === 'true' && $order->tax_details)
    <div class="qr-section">
        <div class="qr-title">Para facturar escanea el código QR</div>
        
        @php
            // 🚀 DEMO: URL temporal que redirige a Google (fácil cambiar después)
            $demo_url = "https://google.com/search?q=OCCR+Facturación+Orden+" . ($order->order_number ?? $order->id);
            
            // 🔧 URL final será así (cuando esté listo):
            // $final_url = "https://occr.pixelcrafters.digital/facturar/" . ($order->order_number ?? $order->id) . "-" . Str::random(6);
        @endphp
        
        <!-- QR Code generado con Simple QR Code -->
        <div style="text-align: center; margin: 8px 0;">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode($demo_url) }}" 
                 alt="QR Facturación" 
                 style="border: 2px solid #8B5E3C; border-radius: 8px; padding: 4px; background: white;">
        </div>
        
        <div style="font-size: 9px; color: #8B5E3C; font-weight: bold; text-align: center; margin-top: 4px;">
            Facturación Digital Disponible
        </div>
        
        <div style="font-size: 8px; color: #666; text-align: center; margin-top: 2px;">
            Válido por 30 días después de tu compra
        </div>
        
        <!-- 💡 NOTA PARA DESARROLLO -->
        <div style="font-size: 7px; color: #999; text-align: center; margin-top: 4px; font-style: italic;">
            Demo: actualmente redirige a Google
        </div>
    </div>
    @else
    <!-- ======== INFORMACIÓN DE CONTACTO SIN FACTURACIÓN ======== -->
    <div style="text-align: center; margin: 8px 0; padding: 4px; background: #f8f9fa; border-radius: 4px; font-size: 8px;">
        <strong>Para aclaraciones:</strong><br>
        WhatsApp: +52 55 1234 5678<br>
        Email: contacto@occr.com
    </div>
    @endif

    <!-- ======== PIE DE PÁGINA ======== -->
    <div class="footer">
        <div class="footer-thanks">
            ¡Gracias por tu compra!
        </div>
        <div class="footer-social">
            Síguenos en redes sociales<br>
            Instagram: @OCCRProductos<br>
            Facebook: OCCR Productos
        </div>
        <div class="footer-legal">
            OCCR Productos | México 2025<br>
            Atención al cliente: WhatsApp +52 55 1234 5678<br>
            Horario: Lun-Dom 8:00 a 22:00 hrs
        </div>
    </div>
</div>
</body>
</html>
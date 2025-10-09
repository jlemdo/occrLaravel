@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.order-header {
    background: white;
    color: #495057;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.order-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

.info-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.info-label {
    font-weight: 600;
    color: #495057;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-value {
    color: #6c757d;
    font-weight: 500;
}

.status-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-open { background: #fff3cd; color: #856404; }
.status-on-the-way { background: #d1ecf1; color: #0c5460; }
.status-delivered { background: #d4edda; color: #155724; }

.guest-card {
    background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    color: #8b5a00;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 2rem;
}

.product-card {
    background: white;
    border-radius: 12px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.price-badge {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    font-weight: 600;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.qty-badge {
    background: #0d6efd;
    color: white;
    border-radius: 50px;
    padding: 0.3rem 0.8rem;
    font-size: 0.8rem;
    font-weight: 600;
}

.map-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: #495057;
}

.back-button {
    background: #6c757d;
    border: 1px solid #6c757d;
    color: white;
    border-radius: 10px;
    padding: 0.5rem 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.back-button:hover {
    background: #5a6268;
    border-color: #545b62;
    color: white;
    transform: translateY(-1px);
}

.order-summary {
    background: white;
    color: #495057;
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
}

.total-row {
    border-top: 1px solid #dee2e6;
    margin-top: 1rem;
    padding-top: 1rem;
    font-size: 1.1rem;
    font-weight: 600;
}
</style>

<!-- Header del Pedido -->
<div class="order-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="mb-2 fw-bold">🛒 Pedido #{{$order->order_number ?? $id}}</h2>
            <p class="mb-3 opacity-75">📅 Realizado el {{ $order->created_at->format('d/m/Y') }} a las {{ $order->created_at->format('H:i') }}</p>
            <div class="d-flex align-items-center gap-3">
                <span class="status-badge 
                    @if($order->status == 'Open') status-open
                    @elseif($order->status == 'On the Way') status-on-the-way
                    @elseif($order->status == 'Delivered') status-delivered
                    @else status-open @endif">
                    @if($order->status == 'Open') 📋 Abierto
                    @elseif($order->status == 'On the Way') 🚚 En Camino
                    @elseif($order->status == 'Delivered') ✅ Entregado
                    @else {{ $order->status }} @endif
                </span>
                <span class="badge bg-light text-dark">ID: {{ $id }}</span>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.allcustomers') }}" class="back-button">
                <i class="fas fa-arrow-left"></i>Volver a Pedidos
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Información del Cliente -->
        @if($order->userid)
            @php
                $thisuser = App\Models\User::where('id', $order->userid)->first();
            @endphp
            @if($thisuser)
            <div class="info-card">
                <h5 class="section-title">
                    <i class="fas fa-user text-primary"></i>Información del Cliente
                </h5>
                
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-id-card text-primary"></i>Nombre Completo:
                    </div>
                    <div class="info-value">{{ $thisuser->first_name ?? 'Sin nombre' }} {{ $thisuser->last_name ?? '' }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-envelope text-success"></i>Email:
                    </div>
                    <div class="info-value">
                        <a href="mailto:{{ $thisuser->email ?? $order->user_email }}" class="text-decoration-none">{{ $thisuser->email ?? $order->user_email }}</a>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-phone text-warning"></i>Teléfono:
                    </div>
                    <div class="info-value">
                        @if($thisuser->phone)
                            <a href="tel:{{ $thisuser->phone }}" class="text-decoration-none">{{ $thisuser->phone }}</a>
                        @else
                            No especificado
                        @endif
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-map-marker-alt text-danger"></i>Dirección de Entrega:
                    </div>
                    <div class="info-value">{{ $order->delivery_address ?: ($thisuser->address ?: 'No especificada') }}</div>
                </div>
                
                @if($order->tax_details)
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-file-invoice text-info"></i>RFC:
                    </div>
                    <div class="info-value">{{ $order->tax_details }}</div>
                </div>
                @endif
            </div>
            @else
            <!-- Usuario registrado pero no encontrado -->
            <div class="info-card">
                <h5 class="section-title">
                    <i class="fas fa-user text-warning"></i>Usuario No Encontrado
                </h5>
                <div class="info-row">
                    <div class="info-label">Estado:</div>
                    <div class="info-value">Usuario ID {{ $order->userid }} no existe en el sistema</div>
                </div>
                @if($order->user_email)
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-envelope text-success"></i>Email:
                    </div>
                    <div class="info-value">{{ $order->user_email }}</div>
                </div>
                @endif
                @if($order->tax_details)
                <div class="info-row">
                    <div class="info-label">
                        <i class="fas fa-file-invoice text-info"></i>RFC:
                    </div>
                    <div class="info-value">{{ $order->tax_details }}</div>
                </div>
                @endif
            </div>
            @endif
        @else
            <!-- Usuario Guest -->
            <div class="guest-card">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <i class="fas fa-user-secret fa-2x me-3"></i>
                    <h4 class="mb-0">👤 Cliente Invitado</h4>
                </div>
                <p class="mb-0">Este pedido fue realizado por un usuario no registrado en el sistema.</p>
                @if($order->guest_name || $order->guest_email || $order->guest_phone || $order->tax_details)
                <div class="mt-3 pt-3 border-top border-warning">
                    @if($order->guest_name)<p class="mb-1"><strong>Nombre:</strong> {{ $order->guest_name }}</p>@endif
                    @if($order->guest_email)<p class="mb-1"><strong>Email:</strong> {{ $order->guest_email }}</p>@endif
                    @if($order->guest_phone)<p class="mb-1"><strong>Teléfono:</strong> {{ $order->guest_phone }}</p>@endif
                    @if($order->tax_details)<p class="mb-0"><strong>RFC:</strong> {{ $order->tax_details }}</p>@endif
                </div>
                @endif
            </div>
        @endif
        <!-- Productos del Pedido -->
        <div class="info-card">
            <h5 class="section-title">
                <i class="fas fa-shopping-basket text-success"></i>Productos del Pedido
            </h5>
            
            @if($detail->isNotEmpty())
                @php
                    $totalAmount = 0;
                    $totalItems = 0;
                @endphp
                @foreach ($detail as $details)
                    @php
                        $itemTotal = $details->item_price * $details->item_qty;
                        $totalAmount += $itemTotal;
                        $totalItems += $details->item_qty;
                    @endphp
                    <div class="product-card">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                @if($details->item_image && $details->item_image != '')
                                    <img src="{{ $details->item_image }}" alt="{{ $details->item_name }}" class="product-image">
                                @else
                                    <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fw-semibold">{{ $details->item_name }}</h6>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="price-badge">
                                            ${{ number_format($details->item_price, 2) }} c/u
                                        </div>
                                        <div class="qty-badge">
                                            {{ $details->item_qty }} unidades
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-primary fs-5">
                                            ${{ number_format($itemTotal, 2) }}
                                        </div>
                                        <small class="text-muted">Subtotal</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Resumen del Pedido -->
                <div class="order-summary">
                    <h6 class="mb-3 fw-bold">📋 Resumen del Pedido</h6>
                    <div class="summary-row">
                        <span>🛍️ Total de productos:</span>
                        <span class="fw-semibold">{{ $detail->count() }} productos diferentes</span>
                    </div>
                    <div class="summary-row">
                        <span>📦 Total de unidades:</span>
                        <span class="fw-semibold">{{ $totalItems }} unidades</span>
                    </div>
                    @if($order->shipping_cost && $order->shipping_cost > 0)
                    <div class="summary-row">
                        <span>🚚 Costo de entrega:</span>
                        <span class="fw-semibold">${{ number_format($order->shipping_cost, 2) }}</span>
                    </div>
                    @endif
                    @if($order->discount_amount && $order->discount_amount > 0)
                    <div class="summary-row">
                        <span>🎫 Descuento aplicado:</span>
                        <span class="fw-semibold text-success">-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    @endif
                    <div class="summary-row total-row">
                        <span class="fs-5">💰 Total a pagar:</span>
                        <span class="fs-4 fw-bold">
                            @if($order->total_amount && $order->total_amount > 0)
                                ${{ number_format($order->total_amount, 2) }}
                            @else
                                ${{ number_format($totalAmount + ($order->shipping_cost ?? 0) - ($order->discount_amount ?? 0), 2) }}
                            @endif
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay productos en este pedido</h5>
                    <p class="text-muted">Los detalles del pedido no están disponibles</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Columna Lateral -->
    <div class="col-lg-4">
        <!-- Información del Pedido -->
        <div class="info-card">
            <h5 class="section-title">
                <i class="fas fa-info-circle text-info"></i>Detalles del Pedido
            </h5>
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-hashtag text-primary"></i>Número de Pedido:
                </div>
                <div class="info-value">{{ $order->order_number ?? $id }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-calendar-alt text-warning"></i>Fecha del Pedido:
                </div>
                <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
            
            @if($order->delivery_date || $order->delivery_slot)
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-truck text-info"></i>Entrega Programada:
                </div>
                <div class="info-value">
                    @if($order->delivery_date)
                        {{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}
                    @endif
                    @if($order->delivery_slot)
                        <br><small>{{ $order->delivery_slot }}</small>
                    @endif
                    @if(!$order->delivery_date && !$order->delivery_slot)
                        No especificada
                    @endif
                </div>
            </div>
            @endif
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-credit-card text-success"></i>Estado de Pago:
                </div>
                <div class="info-value">
                    @if($order->payment_status == 'paid' || $order->payment_status == 'Paid')
                        <span class="badge bg-success">💳 Pagado</span>
                    @else
                        <span class="badge bg-warning">⏳ Pendiente</span>
                    @endif
                </div>
            </div>
            
            <!-- Información del Repartidor -->
            @php
                $dman = $order->dman;
                $deliveryMan = null;
                if($dman > 0){
                    $deliveryMan = App\Models\User::where('id', $dman)->first();
                }
            @endphp
            
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-truck text-info"></i>Repartidor:
                </div>
                <div class="info-value">
                    @if($deliveryMan)
                        <div>
                            <strong>{{ $deliveryMan->first_name }} {{ $deliveryMan->last_name }}</strong>
                            @if($deliveryMan->phone)
                                <br><small><a href="tel:{{ $deliveryMan->phone }}" class="text-decoration-none">{{ $deliveryMan->phone }}</a></small>
                            @endif
                        </div>
                    @else
                        <span class="text-muted">Sin asignar</span>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Mapa de Ubicación -->
        @if($order->customer_lat && $order->customer_long)
        <div class="info-card">
            <h5 class="section-title">
                <i class="fas fa-map-marked-alt text-danger"></i>Ubicación de Entrega
            </h5>
            <div class="map-container">
                <iframe
                    width="100%"
                    height="250"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps?q={{ $order->customer_lat }},{{ $order->customer_long }}&hl=es&z=16&output=embed">
                </iframe>
            </div>
            <div class="mt-2 text-center">
                <a href="https://www.google.com/maps?q={{ $order->customer_lat }},{{ $order->customer_long }}" 
                   target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-external-link-alt me-1"></i>Abrir en Google Maps
                </a>
            </div>
        </div>
        @endif
        
        <!-- Acciones -->
        <div class="info-card">
            <h5 class="section-title">
                <i class="fas fa-cogs text-secondary"></i>Acciones
            </h5>
            
            <div class="d-grid gap-2">
                @if($order->invoice)
                <a href="{{ asset('invoices/' . $order->invoice) }}" target="_blank" class="btn btn-outline-success">
                    @if($order->need_invoice === 'true' && $order->tax_details)
                        <i class="fas fa-file-invoice me-2"></i>Descargar Factura
                    @else
                        <i class="fas fa-receipt me-2"></i>Descargar Ticket
                    @endif
                </a>
                @endif

                @if($order->userid)
                    {{-- Ver todos los pedidos de este usuario específico --}}
                    <a href="{{ route('admin.allcustomers') }}?user_id={{ $order->userid }}" class="btn btn-outline-primary">
                        <i class="fas fa-list me-2"></i>Ver Pedidos de Este Cliente
                    </a>
                @else
                    {{-- Si es Guest, mostrar todos los pedidos --}}
                    <a href="{{ route('admin.allcustomers') }}" class="btn btn-outline-primary">
                        <i class="fas fa-list me-2"></i>Ver Todos los Pedidos
                    </a>
                @endif

                {{-- Botón comentado temporalmente
                @if($deliveryMan)
                <a href="tel:{{ $deliveryMan->phone }}" class="btn btn-outline-warning">
                    <i class="fas fa-phone me-2"></i>Contactar Repartidor
                </a>
                @endif
                --}}
            </div>
        </div>
    </div>
</div>
                       
@endsection
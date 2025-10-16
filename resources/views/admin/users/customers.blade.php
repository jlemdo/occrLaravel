@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.order-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    border: 1px solid #e3e6f0;
    background: white;
    margin-bottom: 1rem;
}

.order-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #0d6efd;
}

.order-header {
    background: white;
    color: #495057;
    border-radius: 12px 12px 0 0;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
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
.status-cancelled { background: #f8d7da; color: #721c24; }

.payment-badge {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.3rem 0.6rem;
    border-radius: 12px;
}

.payment-paid { background: #d4edda; color: #155724; }
.payment-pending { background: #f8d7da; color: #721c24; }

.order-products {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 0.75rem;
    margin: 0.5rem 0;
    border-left: 4px solid #0d6efd;
}


.stats-card {
    background: white;
    color: #495057;
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
    margin-bottom: 1rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.action-dropdown .dropdown-menu {
    border-radius: 10px;
    border: none;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    padding: 0.5rem;
}

.action-dropdown .dropdown-item {
    border-radius: 6px;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
}

.action-dropdown .dropdown-item:hover {
    background: #f8f9fa;
    transform: translateX(3px);
}

.search-container {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-box {
    position: relative;
    max-width: 500px;
}

.search-input {
    border-radius: 12px;
    border: 2px solid #e9ecef;
    padding: 0.75rem 3rem 0.75rem 1.25rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
}

.search-input:focus {
    border-color: #0d6efd;
    background: white;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1), inset 0 2px 4px rgba(0,0,0,0.05);
    outline: none;
}

.search-box-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1.1rem;
    pointer-events: none;
    transition: all 0.3s ease;
}

.search-input:focus + .search-box-icon {
    color: #0d6efd;
}

.search-stats {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.75rem;
    font-size: 0.875rem;
    color: #6c757d;
}

.search-hint {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
}
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">🛒 Gestión de Pedidos</h2>
            <p class="text-muted mb-0">Administra y rastrea todos los pedidos del sistema</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="stats-card">
                    <div class="fw-bold fs-4">{{$users->total()}}</div>
                    <small>Total Pedidos</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Buscador y Exportar -->
    <div class="search-container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-3 d-flex align-items-center gap-2">
                    <i class="fas fa-search text-primary"></i>
                    Buscar Pedidos
                </h5>
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" 
                               placeholder="Buscar por número de pedido, cliente, estado..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="search-stats">
                        <span class="search-hint">💡 Búsqueda en tiempo real</span>
                        <small id="search-results">Mostrando {{$users->count()}} de {{$users->total()}} pedidos</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3 d-flex align-items-center gap-2">
                    <i class="fas fa-download text-success"></i>
                    Exportar Pedidos
                </h5>
                
                <!-- Formulario de Exportación -->
                <form action="{{ route('admin.exportOrders') }}" method="POST" class="export-form">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">Desde:</label>
                            <input type="date" name="from_date" class="form-control form-control-sm" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Hasta:</label>
                            <input type="date" name="to_date" class="form-control form-control-sm" value="{{ request('to_date') }}">
                        </div>
                    </div>
                    
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">Estado:</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="all">Todos los estados</option>
                                <option value="Open">📋 Abierto</option>
                                <option value="On the Way">🚚 En Camino</option>
                                <option value="Delivered">✅ Entregado</option>
                                <option value="Cancelled">❌ Cancelado</option>
                                <option value="guest">👤 Solo Guests</option>
                                <option value="registered">👥 Solo Registrados</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Formato:</label>
                            <select name="format" class="form-select form-select-sm">
                                <option value="excel">📊 Excel (.xls)</option>
                                <option value="csv">📄 CSV</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-sm flex-fill">
                            <i class="fas fa-download me-1"></i>
                            Exportar Datos
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetExportForm()">
                            <i class="fas fa-refresh me-1"></i>
                        </button>
                    </div>
                </form>
                
                <div class="mt-2">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Se exportarán {{ $users->total() }} pedidos con información completa
                    </small>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <span class="badge bg-success" id="visible-count" style="display: none;"></span>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <small class="text-muted">Página {{$users->currentPage()}} de {{$users->lastPage()}}</small>
            </div>
        </div>
    </div>

    <!-- Lista de Pedidos -->
    <div class="row">
        @forelse ($users as $order)
            @php 
                $customer = App\Models\User::where('id', $order->userid)->first();
                $orderDetails = App\Models\Ordedetail::where('orderno', $order->order_number ?? $order->id)->get();
                $deliveryMan = App\Models\User::where('id', $order->dman)->first();
            @endphp
            
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="order-card">
                    <!-- Header -->
                    <div class="order-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1 fw-bold">Pedido #{{ $order->order_number ?? $order->id }}</h6>
                                <small class="opacity-75">{{ $order->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="text-end">
                                <span class="status-badge
                                    @if($order->status == 'Open') status-open
                                    @elseif($order->status == 'On the Way') status-on-the-way
                                    @elseif($order->status == 'Delivered') status-delivered
                                    @elseif($order->status == 'Cancelled') status-cancelled
                                    @else status-open @endif">
                                    @if($order->status == 'Open') 📋 Abierto
                                    @elseif($order->status == 'On the Way') 🚚 En Camino
                                    @elseif($order->status == 'Delivered') ✅ Entregado
                                    @elseif($order->status == 'Cancelled') ❌ Cancelado
                                    @else {{ $order->status }} @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contenido -->
                    <div class="p-3">
                        <!-- Cliente -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user text-primary me-2"></i>
                                <strong>Cliente:</strong>
                            </div>
                            <div class="ms-4">
                                @if($customer)
                                    <span class="fw-semibold">{{ $customer->first_name }} {{ $customer->last_name }}</span>
                                @else
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-secondary me-2">
                                            <i class="fas fa-user-slash me-1"></i>VISITANTE
                                        </span>
                                        <span class="text-muted">{{ $order->user_email ?? 'Sin email' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Productos -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-shopping-basket text-success me-2"></i>
                                <strong>Productos:</strong>
                            </div>
                            <div class="order-products">
                                @if($orderDetails->isNotEmpty())
                                    @foreach ($orderDetails as $detail)
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span>{{ $detail->item_name }}</span>
                                            <span class="badge bg-primary">{{ $detail->item_qty }} und.</span>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-muted">Sin detalles de productos</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Pago -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-credit-card text-warning me-2"></i>
                                    <strong>Estado de Pago:</strong>
                                </div>
                                <span class="payment-badge 
                                    @if($order->payment_status == 'paid' || $order->payment_status == 'Paid') payment-paid
                                    @else payment-pending @endif">
                                    @if($order->payment_status == 'paid' || $order->payment_status == 'Paid') 
                                        💳 Pagado 
                                    @else 
                                        ⏳ Pendiente 
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <!-- Repartidor -->
                        @if(auth()->user()->usertype != 'driver')
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-truck text-info me-2"></i>
                                <strong>Repartidor:</strong>
                            </div>
                            <div class="ms-4">
                                <select class="form-select form-select-sm update-status-d" 
                                        onChange="change_sts_d(this.value, '{{ $order->id }}')">
                                    <option value="">Asignar Repartidor</option>
                                    @foreach ($all_d as $driver)
                                        <option @if($order->dman == $driver->id) selected @endif value="{{$driver->id}}">
                                            🚚 {{$driver->first_name}} {{$driver->last_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Estado del Pedido -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-tasks text-secondary me-2"></i>
                                <strong>Cambiar Estado:</strong>
                            </div>
                            <div class="ms-4">
                                <select class="form-select form-select-sm update-status"
                                        onChange="change_sts(this.value, '{{ $order->id }}')">
                                    <option @if($order->status=='Open') selected @endif value="Open">📋 Abierto</option>
                                    <option @if($order->status=='On the Way') selected @endif value="On the Way">🚚 En Camino</option>
                                    <option @if($order->status=='Delivered') selected @endif value="Delivered">✅ Entregado</option>
                                    <option @if($order->status=='Cancelled') selected @endif value="Cancelled">❌ Cancelado</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Acciones -->
                        <div class="d-flex gap-2 pt-2 border-top">
                            <a class="btn btn-outline-primary btn-sm flex-fill" href="{{URL::to('ordershowd/'.$order->id)}}">
                                <i class="fas fa-eye me-1"></i>Ver Detalles
                            </a>
                            <a class="btn btn-outline-success btn-sm flex-fill" 
                               href="{{ asset('invoices/' . $order->invoice) }}" target="_blank">
                                @if($order->need_invoice === 'true' && $order->tax_details)
                                    <i class="fas fa-file-invoice me-1"></i>Factura
                                @else
                                    <i class="fas fa-receipt me-1"></i>Ticket
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay pedidos registrados</h4>
                    <p class="text-muted">Los pedidos aparecerán aquí cuando se realicen compras</p>
                </div>
            </div>
        @endforelse
    </div>
    <!-- Paginación Mejorada -->
    @if($users->hasPages())
    <div class="mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        <span class="text-muted">
                            Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }} pedidos
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        @if (!$users->onFirstPage())
                            <a href="{{ $users->previousPageUrl() }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-chevron-left me-1"></i>Anterior
                            </a>
                        @endif
                        
                        <ul class="pagination pagination-sm mb-0">
                            @php
                                $start = max($users->currentPage() - 2, 1);
                                $end = min($start + 4, $users->lastPage());
                                $start = max($end - 4, 1);
                            @endphp
                            
                            @if($start > 1)
                                <li class="page-item">
                                    <a href="{{ $users->url(1) }}" class="page-link">1</a>
                                </li>
                                @if($start > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                            @endif
                            
                            @for ($i = $start; $i <= $end; $i++)
                                <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                                    <a href="{{ $users->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            @if($end < $users->lastPage())
                                @if($end < $users->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a href="{{ $users->url($users->lastPage()) }}" class="page-link">{{ $users->lastPage() }}</a>
                                </li>
                            @endif
                        </ul>
                        
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="btn btn-outline-primary btn-sm ms-2">
                                Siguiente<i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
// Función para actualizar estado del pedido
function change_sts(sts, id) {
    var orderId = id;
    var newStatus = sts;
    var token = "{{ csrf_token() }}";
    
    // Mostrar loading
    $(`select[onchange*="${id}"]`).prop('disabled', true);
    
    $.ajax({
        url: "{{ route('order.updateStatus') }}",
        type: "POST",
        data: {
            _token: token,
            id: orderId,
            status: newStatus
        },
        success: function (response) {
            if (response.success) {
                // Toast de éxito
                iziToast.success({
                    title: '✅ ¡Actualizado!',
                    message: 'Estado del pedido actualizado correctamente',
                    position: 'topRight',
                    timeout: 3000
                });
                
                // Actualizar el badge visualmente
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                iziToast.error({
                    title: '❌ Error',
                    message: 'No se pudo actualizar el estado',
                    position: 'topRight'
                });
            }
        },
        error: function () {
            iziToast.error({
                title: '❌ Error',
                message: 'Algo salió mal. Inténtalo de nuevo.',
                position: 'topRight'
            });
        },
        complete: function() {
            $(`select[onchange*="${id}"]`).prop('disabled', false);
        }
    });
}

// Función para actualizar repartidor
function change_sts_d(sts, id) {
    var orderId = id;
    var deliveryManId = sts;
    var token = "{{ csrf_token() }}";
    
    // Mostrar loading
    $(`.update-status-d`).prop('disabled', true);
    
    $.ajax({
        url: "{{ route('order.updateStatusd') }}",
        type: "POST",
        data: {
            _token: token,
            id: orderId,
            status: deliveryManId
        },
        success: function (response) {
            if (response.success) {
                iziToast.success({
                    title: '🚚 ¡Asignado!',
                    message: 'Repartidor asignado correctamente',
                    position: 'topRight',
                    timeout: 3000
                });
            } else {
                iziToast.error({
                    title: '❌ Error',
                    message: 'No se pudo asignar el repartidor',
                    position: 'topRight'
                });
            }
        },
        error: function () {
            iziToast.error({
                title: '❌ Error',
                message: 'Algo salió mal. Inténtalo de nuevo.',
                position: 'topRight'
            });
        },
        complete: function() {
            $(`.update-status-d`).prop('disabled', false);
        }
    });
}

// Funcionalidad de búsqueda en tiempo real
$(document).ready(function() {
    $('.search-input').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('.order-card').each(function() {
            var cardText = $(this).text().toLowerCase();
            if (cardText.includes(searchTerm)) {
                $(this).closest('.col-12, .col-lg-6, .col-xl-4').show();
            } else {
                $(this).closest('.col-12, .col-lg-6, .col-xl-4').hide();
            }
        });
        
        // Mostrar mensaje si no hay resultados y actualizar contadores
        var visibleCards = $('.order-card:visible').length;
        var totalCards = $('.order-card').length;
        
        // Actualizar contadores solo durante búsqueda
        if (searchTerm !== '') {
            // Mostrar contador cuando hay búsqueda activa
            $('#visible-count').show().text(visibleCards + ' Encontrados');
            $('#search-results').text('Mostrando ' + visibleCards + ' resultados de "' + searchTerm + '"');
            
            if (visibleCards === 0) {
                if ($('#no-results').length === 0) {
                    $('.row').append(`
                        <div id="no-results" class="col-12 text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No se encontraron pedidos</h4>
                            <p class="text-muted">Intenta con otros términos de búsqueda</p>
                        </div>
                    `);
                }
                $('#visible-count').removeClass('bg-success').addClass('bg-warning');
            } else {
                $('#no-results').remove();
                $('#visible-count').removeClass('bg-warning').addClass('bg-success');
            }
        } else {
            // Ocultar contador cuando no hay búsqueda
            $('#visible-count').hide();
            $('#search-results').text('Mostrando {{$users->count()}} de {{$users->total()}} pedidos');
            $('#no-results').remove();
        }
    });
});

// Función para resetear formulario de exportación
function resetExportForm() {
    document.querySelector('.export-form').reset();
}

// Mostrar loading durante exportación
$(document).ready(function() {
    $('.export-form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Exportando...');
        
        // Re-habilitar botón después de 5 segundos (el archivo ya se habrá descargado)
        setTimeout(() => {
            submitBtn.prop('disabled', false).html(originalText);
        }, 5000);
    });
});
</script>               
@endsection
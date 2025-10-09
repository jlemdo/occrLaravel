@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.promotion-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.promotion-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.promotion-card.coupon-card {
    background: linear-gradient(135deg, #fff8e1 0%, #fffde7 100%);
    border-left: 5px solid #ff9800;
}

.promotion-card.discount-card {
    background: linear-gradient(135deg, #e8f5e8 0%, #f1f8e9 100%);
    border-left: 5px solid #4caf50;
}

.coupon-badge {
    background: linear-gradient(45deg, #ff9800, #ff6f00);
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
    padding: 0.5rem 1.2rem;
    border-radius: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
}

.coupon-badge::before {
    content: '';
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 50%;
}

.coupon-badge::after {
    content: '';
    position: absolute;
    right: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 50%;
}

.promotion-badge {
    background: linear-gradient(45deg, #4caf50, #2e7d32);
    color: white;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
}

.promotion-badge::before {
    content: '';
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 50%;
}

.promotion-badge::after {
    content: '';
    position: absolute;
    right: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 50%;
}

.discount-amount {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2e7d32;
    line-height: 1;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.promotion-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.coupon-icon {
    background: linear-gradient(45deg, #fff3e0, #ffe0b2);
    color: #ef6c00;
}

.discount-icon {
    background: linear-gradient(45deg, #e8f5e8, #c8e6c9);
    color: #388e3c;
}

.status-active { 
    background: #d4edda; 
    color: #155724; 
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-inactive { 
    background: #f8d7da; 
    color: #721c24; 
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-warning { 
    background: #fff3cd; 
    color: #856404; 
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.promotion-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 1rem 0;
    padding: 1rem;
    background: rgba(255,255,255,0.7);
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.05);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    margin-top: 1rem;
}

.btn-edit {
    background: #17a2b8;
    border-color: #17a2b8;
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.btn-edit:hover {
    background: #138496;
    color: white;
    transform: translateY(-1px);
}

.btn-delete {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.btn-delete:hover {
    background: #c82333;
    color: white;
    transform: translateY(-1px);
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
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">🎫 Cupones y Promociones</h2>
            <p class="text-muted mb-0">Gestiona descuentos y ofertas especiales</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="stats-card">
                    <div class="fw-bold fs-4">{{count($timeline)}}</div>
                    <small>Total Promociones</small>
                </div>
                <a href="{{URL::to('newproposalbattery')}}" class="btn btn-primary action-btn">
                    <span class="fas fa-plus me-2"></span>Nueva Promoción
                </a>
            </div>
        </div>
    </div>

    <!-- Buscador -->
    <div class="search-container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="mb-3 d-flex align-items-center gap-2">
                    <i class="fas fa-search text-primary"></i>
                    Buscar Promociones
                </h5>
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" 
                               placeholder="Buscar por nombre, código, descuento..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="search-stats">
                        <span class="search-hint">💡 Búsqueda en tiempo real</span>
                        <small id="search-results">Mostrando {{count($timeline)}} promociones</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex flex-column align-items-end gap-2">
                    <div class="d-flex gap-2">
                        <span class="badge bg-success" id="visible-count" style="display: none;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Promociones -->
    <div class="row">
        @forelse ($timeline as $time)
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="promotion-card {{ $time->is_coupon ? 'coupon-card' : 'discount-card' }}">
                    
                    <!-- Header con icono -->
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <div class="promotion-icon {{ $time->is_coupon ? 'coupon-icon' : 'discount-icon' }}">
                                @if($time->is_coupon)
                                    <i class="fas fa-ticket-alt"></i>
                                @else
                                    <i class="fas fa-percent"></i>
                                @endif
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1 fw-bold">{{ $time->name }}</h6>
                                <small class="text-muted">
                                    @if($time->is_coupon)
                                        🎫 Cupón
                                    @else
                                        🎯 Promoción {{ $time->type == 'Global' ? '(Todos los usuarios)' : '(Usuarios específicos)' }}
                                    @endif
                                </small>
                            </div>
                        </div>
                        
                        <!-- Estado -->
                        @php
                            $now = now();
                            $isActive = true;
                            $statusText = 'Activo';
                            $statusClass = 'status-active';
                            
                            if($time->is_coupon) {
                                if($time->from && $now->lt($time->from)) {
                                    $isActive = false;
                                    $statusText = 'Inicia ' . \Carbon\Carbon::parse($time->from)->format('d/m');
                                    $statusClass = 'status-warning';
                                } elseif($time->to && $now->gt($time->to)) {
                                    $isActive = false;
                                    $statusText = 'Expirado';
                                    $statusClass = 'status-inactive';
                                }
                            }
                        @endphp
                        <span class="{{ $statusClass }}">{{ $statusText }}</span>
                    </div>

                    <!-- Código de cupón o alcance de promoción -->
                    @if($time->is_coupon && $time->coupon_code)
                        <div class="text-center mb-3">
                            <div class="coupon-badge">
                                <i class="fas fa-tag"></i>
                                {{ $time->coupon_code }}
                            </div>
                        </div>
                    @elseif(!$time->is_coupon)
                        <div class="text-center mb-3">
                            <div class="promotion-badge">
                                <i class="fas fa-users"></i>
                                {{ $time->type == 'Global' ? 'TODOS LOS USUARIOS' : 'USUARIOS ESPECÍFICOS' }}
                            </div>
                        </div>
                    @endif

                    <!-- Descuento principal -->
                    <div class="text-center mb-3">
                        <div class="discount-amount">
                            @if($time->discount_type === 'fixed')
                                <i class="fas fa-dollar-sign" style="font-size: 2rem;"></i>
                                <span>{{ number_format($time->discount, 0) }}</span>
                            @else
                                <span>{{ $time->discount }}</span>
                                <i class="fas fa-percent" style="font-size: 1.8rem;"></i>
                            @endif
                        </div>
                        <small class="text-muted">{{ $time->discount_type === 'fixed' ? 'Descuento fijo' : 'Descuento porcentual' }}</small>
                    </div>

                    <!-- Detalles -->
                    <div class="promotion-details">
                        <div class="text-center">
                            <div class="fw-semibold">${{ number_format($time->minimum_amount ?? 0, 0) }}</div>
                            <small class="text-muted">Mínimo</small>
                        </div>
                        
                        @if($time->is_coupon)
                        <div class="text-center">
                            @if($time->from)
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($time->from)->format('d/m') }}</div>
                                <small class="text-muted">Desde</small>
                            @else
                                <div class="text-muted">—</div>
                                <small class="text-muted">Desde</small>
                            @endif
                        </div>
                        
                        <div class="text-center">
                            @if($time->to)
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($time->to)->format('d/m') }}</div>
                                <small class="text-muted">Hasta</small>
                            @else
                                <div class="text-muted">∞</div>
                                <small class="text-muted">Sin límite</small>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Acciones -->
                    <div class="action-buttons">
                        <a href="{{URL::to('proposalbatteryEdit/'.$time->id)}}" class="btn btn-edit flex-fill">
                            <i class="fas fa-edit me-1"></i>Editar
                        </a>
                        
                        <form id="destroy-data{{ $loop->iteration }}"
                              action="{{ route('deleteproposalbattery', $time->id)}}"
                              method="post" class="flex-fill">
                            @csrf
                            <button type="button" class="btn btn-delete w-100" 
                                    onclick="confirmDelete('destroy-data{{ $loop->iteration }}')">
                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay promociones configuradas</h4>
                    <p class="text-muted">Crea cupones y promociones para impulsar las ventas</p>
                    <a href="{{URL::to('newproposalbattery')}}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Crear Primera Promoción
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
// Función de confirmación para eliminar
function confirmDelete(formId) {
    if (confirm('¿Estás seguro de que deseas eliminar esta promoción? Esta acción no se puede deshacer.')) {
        document.getElementById(formId).submit();
    }
}

// Funcionalidad de búsqueda en tiempo real
$(document).ready(function() {
    $('.search-input').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('.promotion-card').each(function() {
            var cardText = $(this).text().toLowerCase();
            if (cardText.includes(searchTerm)) {
                $(this).closest('.col-12, .col-lg-6, .col-xl-4').show();
            } else {
                $(this).closest('.col-12, .col-lg-6, .col-xl-4').hide();
            }
        });
        
        // Actualizar contadores solo durante búsqueda
        var visibleCards = $('.promotion-card:visible').length;
        var totalCards = $('.promotion-card').length;
        
        if (searchTerm !== '') {
            // Mostrar contador cuando hay búsqueda activa
            $('#visible-count').show().text(visibleCards + ' Encontradas');
            $('#search-results').text('Mostrando ' + visibleCards + ' resultados de "' + searchTerm + '"');
            
            if (visibleCards === 0) {
                if ($('#no-results').length === 0) {
                    $('.row').append(`
                        <div id="no-results" class="col-12 text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No se encontraron promociones</h4>
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
            $('#search-results').text('Mostrando ' + totalCards + ' promociones');
            $('#no-results').remove();
        }
    });
});
</script>               
@endsection
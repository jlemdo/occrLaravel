@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.user-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.user-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    border-color: #0d6efd;
}

.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e9ecef;
    flex-shrink: 0;
}

.user-avatar-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.user-type-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.375rem 0.75rem;
    border-radius: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge {
    font-weight: 600;
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
    border-radius: 15px;
}

.promotion-card {
    background: linear-gradient(45deg, #e3f2fd, #bbdefb);
    border-radius: 10px;
    padding: 0.75rem;
    border: 1px solid #90caf9;
    text-align: center;
    min-height: 80px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.no-promotion {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.password-display {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    border: 1px solid #dee2e6;
    color: #495057;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-edit {
    background: #17a2b8;
    border-color: #17a2b8;
    color: white;
    padding: 0.375rem 0.75rem;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.btn-edit:hover {
    background: #138496;
    border-color: #117a8b;
    color: white;
    transform: translateY(-1px);
}

.btn-toggle {
    background: #ffc107;
    border-color: #ffc107;
    color: #000;
    padding: 0.375rem 0.75rem;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.btn-toggle:hover {
    background: #e0a800;
    border-color: #d39e00;
    color: #000;
    transform: translateY(-1px);
}

.btn-delete {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
    padding: 0.375rem 0.75rem;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.btn-delete:hover {
    background: #c82333;
    border-color: #bd2130;
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

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.user-details h6 {
    margin: 0;
    font-weight: 600;
    color: #495057;
}

.user-id {
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
}

.contact-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.contact-icon {
    color: #6c757d;
    width: 20px;
    text-align: center;
}

.user-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.stat-value {
    display: block;
    font-weight: 600;
    font-size: 1rem;
    color: #495057;
}

.stat-label {
    font-size: 0.75rem;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 0.25rem;
}
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">👥 Gestión de Usuarios</h2>
            <p class="text-muted mb-0">Administra usuarios, roles y promociones del sistema</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="stats-card">
                    <div class="fw-bold fs-4">{{count($users)}}</div>
                    <small>Total Usuarios</small>
                </div>
                <a href="{{URL::to('addnewuser/sale reps')}}" class="btn btn-primary action-btn">
                    <span class="fas fa-plus me-2"></span>Agregar Usuario
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
                    Buscar Usuarios
                </h5>
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" 
                               placeholder="Buscar por nombre, email, teléfono..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="search-stats">
                        <span class="search-hint">💡 Búsqueda en tiempo real</span>
                        <small id="search-results">Mostrando {{count($users)}} usuarios</small>
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

    <!-- Lista de Usuarios -->
    <div class="row">
        @forelse ($users as $user)
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="user-card">
                    
                    <!-- Información del Usuario -->
                    <div class="user-info">
                        @if($user->image)
                            <img src="{{asset('profile/'.$user->image)}}" class="user-avatar" alt="Avatar">
                        @else
                            <div class="user-avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        
                        <div class="user-details">
                            <h6>{{ $user->first_name.' '.$user->last_name }}</h6>
                            <span class="user-id">ID: {{ $user->id }}</span>
                            <div class="mt-2">
                                @if($user->usertype == 'admin')
                                    <span class="user-type-badge bg-danger text-white">👑 Administrador</span>
                                @elseif($user->usertype == 'driver')
                                    <span class="user-type-badge bg-warning text-dark">🚚 Conductor</span>
                                @elseif($user->usertype == 'customer')
                                    <span class="user-type-badge bg-info text-white">🛒 Cliente</span>
                                @else
                                    <span class="user-type-badge bg-secondary text-white">{{ ucfirst($user->usertype) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope contact-icon"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Email</small>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone contact-icon"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Teléfono</small>
                                @if($user->phone)
                                    <a href="tel:{{ $user->phone }}" class="text-decoration-none">{{ $user->phone}}</a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas del Usuario -->
                    <div class="user-stats">
                        <div class="stat-item">
                            @if($user->is_active == 'active')
                                <span class="stat-value text-success">
                                    <i class="fas fa-check-circle"></i> Activo
                                </span>
                            @else
                                <span class="stat-value text-danger">
                                    <i class="fas fa-times-circle"></i> Inactivo
                                </span>
                            @endif
                            <small class="stat-label">Estado</small>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">
                                <div class="password-display">{{ $user->show_password }}</div>
                            </span>
                            <small class="stat-label">Contraseña</small>
                        </div>
                    </div>

                    <!-- Información de Promoción -->
                    <div class="mb-3">
                        <!-- Promoción Individual Asignada -->
                        @if($user->promotional_discount > 0 && $user->promotion_id)
                            @php
                                $promotion = \App\Models\Proposalbattery::find($user->promotion_id);
                            @endphp
                            @if($promotion)
                                <div class="promotion-card mb-2">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-user-tag text-primary me-2"></i>
                                        <strong>{{ $promotion->name }}</strong>
                                        <span class="badge bg-info ms-2" style="font-size: 0.65rem;">Individual</span>
                                    </div>
                                    <div class="text-center">
                                        @if($promotion->discount_type === 'fixed')
                                            <span class="fw-bold text-success">${{ number_format($promotion->discount, 0) }} descuento</span>
                                        @else
                                            <span class="fw-bold text-success">{{ $promotion->discount }}% descuento</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Promociones Automáticas -->
                        @if(isset($user->automatic_promotions) && count($user->automatic_promotions) > 0)
                            @foreach($user->automatic_promotions as $autoPromotion)
                                <div class="promotion-card mb-2" style="background: linear-gradient(45deg, #fff3e0, #ffe0b2); border-color: #ff9800;">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        @if($autoPromotion->type === 'Birthday')
                                            <i class="fas fa-birthday-cake text-warning me-2"></i>
                                        @elseif($autoPromotion->type === 'Global')
                                            <i class="fas fa-globe text-info me-2"></i>
                                        @elseif($autoPromotion->type === 'Normal')
                                            <i class="fas fa-user text-secondary me-2"></i>
                                        @elseif($autoPromotion->type === 'Google')
                                            <i class="fab fa-google text-danger me-2"></i>
                                        @elseif($autoPromotion->type === 'Apple')
                                            <i class="fab fa-apple text-dark me-2"></i>
                                        @else
                                            <i class="fas fa-magic text-primary me-2"></i>
                                        @endif
                                        <strong>{{ $autoPromotion->name }}</strong>
                                        <span class="badge bg-warning text-dark ms-2" style="font-size: 0.65rem;">{{ $autoPromotion->type }}</span>
                                    </div>
                                    <div class="text-center">
                                        @if($autoPromotion->discount_type === 'fixed')
                                            <span class="fw-bold text-success">${{ number_format($autoPromotion->discount, 0) }} descuento</span>
                                        @else
                                            <span class="fw-bold text-success">{{ $autoPromotion->discount }}% descuento</span>
                                        @endif
                                        @if($autoPromotion->minimum_amount > 0)
                                            <div><small class="text-muted">Mín: ${{ number_format($autoPromotion->minimum_amount, 0) }}</small></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- Sin promociones -->
                        @if((!$user->promotional_discount || !$user->promotion_id) && (!isset($user->automatic_promotions) || count($user->automatic_promotions) === 0))
                            <div class="promotion-card no-promotion">
                                <i class="fas fa-minus-circle mb-2"></i>
                                <small>Sin promociones aplicables</small>
                            </div>
                        @endif
                    </div>

                    <!-- Acciones -->
                    <div class="action-buttons">
                        <a href="{{URL::to('userEdit/'.$user->id)}}" class="btn btn-edit flex-fill">
                            <i class="fas fa-edit me-1"></i>Editar
                        </a>
                        
                        @if($user->usertype !='admin')
                            <a href="{{URL::to('usersts/'.$user->id.'/'.$user->is_active)}}" class="btn btn-toggle">
                                @if($user->is_active == 'active')
                                    <i class="fas fa-user-slash"></i>
                                @else
                                    <i class="fas fa-user-check"></i>
                                @endif
                            </a>
                            
                            <form id="destroy-data{{ $loop->iteration }}"
                                  action="{{ route('deleteuser', $user->id)}}"
                                  method="post" class="d-inline">
                                @csrf
                                <button type="button" class="btn btn-delete" 
                                        onclick="confirmDelete('destroy-data{{ $loop->iteration }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay usuarios registrados</h4>
                    <p class="text-muted">Agrega el primer usuario al sistema</p>
                    <a href="{{URL::to('addnewuser/sale reps')}}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Agregar Primer Usuario
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
    if (confirm('⚠️ ¿Estás seguro de que deseas eliminar este usuario?\n\nEsta acción no se puede deshacer.')) {
        document.getElementById(formId).submit();
    }
}

// Funcionalidad de búsqueda en tiempo real
$(document).ready(function() {
    $('.search-input').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('.user-card').each(function() {
            var cardText = $(this).text().toLowerCase();
            if (cardText.includes(searchTerm)) {
                $(this).closest('.col-12, .col-lg-6, .col-xl-4').show();
            } else {
                $(this).closest('.col-12, .col-lg-6, .col-xl-4').hide();
            }
        });
        
        // Actualizar contadores solo durante búsqueda
        var visibleCards = $('.user-card:visible').length;
        var totalCards = $('.user-card').length;
        
        if (searchTerm !== '') {
            // Mostrar contador cuando hay búsqueda activa
            $('#visible-count').show().text(visibleCards + ' Encontrados');
            $('#search-results').text('Mostrando ' + visibleCards + ' resultados de "' + searchTerm + '"');
            
            if (visibleCards === 0) {
                if ($('#no-results').length === 0) {
                    $('.row').append(`
                        <div id="no-results" class="col-12 text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No se encontraron usuarios</h4>
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
            $('#search-results').text('Mostrando ' + totalCards + ' usuarios');
            $('#no-results').remove();
        }
    });
});
</script>               
@endsection
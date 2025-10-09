@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.slot-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.slot-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    border-color: #0d6efd;
}

.day-card {
    background: linear-gradient(135deg, #e8f5e8 0%, #f1f8e9 100%);
    border-left: 5px solid #28a745;
}

.time-card {
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
    border-left: 5px solid #0d6efd;
}

.slot-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f8f9fa;
}

.slot-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
    margin-right: 1rem;
}

.day-icon {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.time-icon {
    background: linear-gradient(45deg, #0d6efd, #6f42c1);
    color: white;
}

.slot-label {
    font-size: 1.2rem;
    font-weight: 600;
    color: #495057;
    margin: 0;
}

.slot-details {
    color: #6c757d;
    font-size: 0.875rem;
    margin: 0.25rem 0;
}

.priority-badge {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.status-inactive {
    background: #6c757d;
    color: white;
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

.empty-state {
    background: white;
    border-radius: 12px;
    padding: 3rem;
    text-align: center;
    border: 2px dashed #dee2e6;
    color: #6c757d;
}

.tab-navigation {
    background: white;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.nav-tabs {
    border: none;
}

.nav-tabs .nav-link {
    border: none;
    border-radius: 8px;
    margin-right: 0.5rem;
    color: #6c757d;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link.active {
    background: #0d6efd;
    color: white;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.3);
}

.nav-tabs .nav-link:hover {
    background: #e9ecef;
    color: #495057;
}

.slot-meta {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 1rem;
    align-items: center;
    margin-top: 1rem;
}
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">🕐 Gestión de Horarios de Entrega</h2>
            <p class="text-muted mb-0">Administra días y horarios disponibles para entregas</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="stats-card">
                    <div class="fw-bold fs-4">
                        {{(isset($deliveryDays) ? count($deliveryDays) : 0) + (isset($deliverySlots) ? count($deliverySlots) : 0)}}
                    </div>
                    <small>Total Configuraciones</small>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-plus me-2"></i>Agregar Nuevo
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{URL::to('newdslots')}}?type=day">
                            <i class="fas fa-calendar me-2"></i>Nuevo Día
                        </a></li>
                        <li><a class="dropdown-item" href="{{URL::to('newdslots')}}?type=slot">
                            <i class="fas fa-clock me-2"></i>Nuevo Horario
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación por Tabs -->
    <div class="tab-navigation">
        <ul class="nav nav-tabs" id="slotsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="days-tab" data-bs-toggle="tab" data-bs-target="#days" type="button" role="tab">
                    <i class="fas fa-calendar me-2"></i>Días de Entrega
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="times-tab" data-bs-toggle="tab" data-bs-target="#times" type="button" role="tab">
                    <i class="fas fa-clock me-2"></i>Horarios Disponibles
                </button>
            </li>
        </ul>
    </div>

    <!-- Buscador -->
    <div class="search-container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="mb-3 d-flex align-items-center gap-2">
                    <i class="fas fa-search text-primary"></i>
                    Buscar Configuraciones
                </h5>
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" 
                               placeholder="Buscar por día, horario, prioridad..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="search-stats">
                        <span class="search-hint">💡 Búsqueda en tiempo real</span>
                        <small id="search-results">Mostrando todas las configuraciones</small>
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

    <!-- Contenido de Tabs -->
    <div class="tab-content" id="slotsTabContent">
        
        <!-- Días de Entrega -->
        <div class="tab-pane fade show active" id="days" role="tabpanel">
            <div class="row">
                @forelse ($deliveryDays ?? [] as $day)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="slot-card day-card">
                            <div class="slot-header">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="slot-icon day-icon">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="slot-label">{{ $day->day_label }}</h6>
                                        <p class="slot-details mb-0">{{ $day->notes ?: 'Sin notas adicionales' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="slot-meta">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="priority-badge">
                                        <i class="fas fa-sort-numeric-up"></i>
                                        Prioridad {{ $day->priority }}
                                    </span>
                                </div>
                                <div>
                                    <span class="status-badge {{ $day->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="fas {{ $day->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                        {{ $day->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Acciones -->
                            <div class="action-buttons mt-3 pt-3 border-top border-light">
                                <a href="{{URL::to('dslotsEdit/'.$day->id)}}?type=day" class="btn btn-edit flex-fill">
                                    <i class="fas fa-edit me-1"></i>Editar Día
                                </a>
                                
                                <form id="destroy-day-{{ $loop->iteration }}"
                                      action="{{ route('deletedslots', $day->id)}}"
                                      method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="day">
                                    <button type="button" class="btn btn-delete" 
                                            onclick="confirmDelete('destroy-day-{{ $loop->iteration }}', '¿Eliminar este día de entrega?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <h4>No hay días configurados</h4>
                            <p class="mb-3">Configura los días disponibles para entrega</p>
                            <a href="{{URL::to('newdslots')}}?type=day" class="btn btn-primary">
                                <i class="fas fa-calendar-plus me-2"></i>Agregar Primer Día
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Horarios de Entrega -->
        <div class="tab-pane fade" id="times" role="tabpanel">
            <div class="row">
                @forelse ($deliverySlots ?? [] as $slot)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="slot-card time-card">
                            <div class="slot-header">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="slot-icon time-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="slot-label">{{ $slot->slot_label }}</h6>
                                        <p class="slot-details mb-0">
                                            <i class="fas fa-hourglass-start me-1"></i>
                                            {{ $slot->start_time }} - {{ $slot->end_time }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="slot-meta">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="priority-badge">
                                        <i class="fas fa-sort-numeric-up"></i>
                                        Prioridad {{ $slot->priority }}
                                    </span>
                                </div>
                                <div>
                                    <span class="status-badge {{ $slot->is_active ? 'status-active' : 'status-inactive' }}">
                                        <i class="fas {{ $slot->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                        {{ $slot->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Acciones -->
                            <div class="action-buttons mt-3 pt-3 border-top border-light">
                                <a href="{{URL::to('dslotsEdit/'.$slot->id)}}?type=slot" class="btn btn-edit flex-fill">
                                    <i class="fas fa-edit me-1"></i>Editar Horario
                                </a>
                                
                                <form id="destroy-slot-{{ $loop->iteration }}"
                                      action="{{ route('deletedslots', $slot->id)}}"
                                      method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="slot">
                                    <button type="button" class="btn btn-delete" 
                                            onclick="confirmDelete('destroy-slot-{{ $loop->iteration }}', '¿Eliminar este horario de entrega?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-clock fa-3x mb-3"></i>
                            <h4>No hay horarios configurados</h4>
                            <p class="mb-3">Define los horarios disponibles para entregas</p>
                            <a href="{{URL::to('newdslots')}}?type=slot" class="btn btn-primary">
                                <i class="fas fa-clock me-2"></i>Agregar Primer Horario
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
// Función de confirmación para eliminar
function confirmDelete(formId, message) {
    if (confirm(message + '\n\nEsta acción no se puede deshacer.')) {
        document.getElementById(formId).submit();
    }
}

// Funcionalidad de búsqueda en tiempo real
$(document).ready(function() {
    $('.search-input').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('.slot-card').each(function() {
            var cardText = $(this).text().toLowerCase();
            if (cardText.includes(searchTerm)) {
                $(this).closest('.col-12, .col-md-6, .col-lg-4').show();
            } else {
                $(this).closest('.col-12, .col-md-6, .col-lg-4').hide();
            }
        });
        
        // Actualizar contadores solo durante búsqueda
        var visibleCards = $('.slot-card:visible').length;
        var totalCards = $('.slot-card').length;
        
        if (searchTerm !== '') {
            // Mostrar contador cuando hay búsqueda activa
            $('#visible-count').show().text(visibleCards + ' Encontrados');
            $('#search-results').text('Mostrando ' + visibleCards + ' resultados de "' + searchTerm + '"');
            
            if (visibleCards === 0) {
                if ($('#no-results').length === 0) {
                    $('.tab-content').append(`
                        <div id="no-results" class="col-12 text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No se encontraron resultados</h4>
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
            $('#search-results').text('Mostrando todas las configuraciones');
            $('#no-results').remove();
        }
    });
});
</script>

@endsection
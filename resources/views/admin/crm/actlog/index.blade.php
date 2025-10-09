@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.activity-card {
    border-left: 4px solid #0d6efd;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.activity-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.activity-badge {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-created { background: #d4edda; color: #155724; }
.badge-updated { background: #fff3cd; color: #856404; }
.badge-deleted { background: #f8d7da; color: #721c24; }

.changes-list {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 0.5rem;
    border: 1px solid #e9ecef;
}

.change-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.change-item:last-child {
    border-bottom: none;
}

.old-value {
    background: #f8d7da;
    color: #721c24;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-family: monospace;
    font-size: 0.85rem;
}

.new-value {
    background: #d4edda;
    color: #155724;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-family: monospace;
    font-size: 0.85rem;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: white;
    font-weight: bold;
}

.icon-created { background: #28a745; }
.icon-updated { background: #ffc107; }
.icon-deleted { background: #dc3545; }

.custom-pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
    margin: 0;
    gap: 5px;
    justify-content: center;
}

.custom-pagination .page-item {
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
}

.custom-pagination .page-item.active .page-link {
    background: #0d6efd;
    color: white;
    border-color: #0d6efd;
}

.custom-pagination .page-link {
    display: inline-block;
    padding: 0.5rem 0.75rem;
    color: #0d6efd;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
}

.custom-pagination .page-link:hover {
    background-color: #e9ecef;
    color: #0a58ca;
    transform: translateY(-1px);
}

.search-filters {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    color: #495057;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.filter-chip {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    margin: 0.25rem;
    color: #6c757d;
    font-size: 0.85rem;
    transition: all 0.2s ease;
}

.filter-chip:hover {
    background: #e9ecef;
    color: #495057;
}
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">📋 Registro de Actividad</h2>
            <p class="text-muted mb-0">Historial completo de cambios en el sistema</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center me-3">
                    <span class="badge bg-primary me-2">{{$projects->total()}}</span>
                    <span class="text-muted small">Total actividades</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="search-filters">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-2">🔍 Filtros de Actividad</h5>
                <div class="d-flex flex-wrap">
                    <span class="filter-chip">📝 Creados</span>
                    <span class="filter-chip">✏️ Editados</span>
                    <span class="filter-chip">🗑️ Eliminados</span>
                    <span class="filter-chip">👤 Por Usuario</span>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <small class="text-muted">Página {{$projects->currentPage()}} de {{$projects->lastPage()}}</small>
            </div>
        </div>
    </div>
    <!-- Lista de Actividades -->
    <div class="row">
        @forelse($projects as $activity)
            <div class="col-12">
                <div class="activity-card">
                    <div class="d-flex align-items-start">
                        <!-- Icono de Actividad -->
                        <div class="activity-icon 
                            @if($activity->event === 'created') icon-created
                            @elseif($activity->event === 'updated') icon-updated  
                            @elseif($activity->event === 'deleted') icon-deleted
                            @else icon-created @endif">
                            @if($activity->event === 'created') +
                            @elseif($activity->event === 'updated') ✏
                            @elseif($activity->event === 'deleted') ✕
                            @else ? @endif
                        </div>
                        
                        <!-- Contenido -->
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1 fw-bold">
                                        @if($activity->event === 'created') 📝 Elemento Creado
                                        @elseif($activity->event === 'updated') ✏️ Elemento Actualizado
                                        @elseif($activity->event === 'deleted') 🗑️ Elemento Eliminado
                                        @else 📋 Actividad Registrada @endif
                                    </h6>
                                    <p class="mb-1 text-muted">{{ $activity->description }}</p>
                                </div>
                                <div class="text-end">
                                    <span class="activity-badge 
                                        @if($activity->event === 'created') badge-created
                                        @elseif($activity->event === 'updated') badge-updated
                                        @elseif($activity->event === 'deleted') badge-deleted
                                        @else badge-created @endif">
                                        {{ ucfirst($activity->event ?? 'Registrado') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Información Adicional -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-tag me-1"></i>
                                    <strong>Módulo:</strong> {{ $activity->log_name ?? 'Sistema' }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    <strong>Por:</strong> {{ $activity->causer ? $activity->causer->first_name . ' ' . $activity->causer->last_name : '🤖 Sistema' }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $activity->created_at->format('d/m/Y H:i:s') }}
                                </small>
                            </div>
                            
                            <!-- Cambios Realizados -->
                            @if($activity->properties && $activity->properties->isNotEmpty())
                            <div class="changes-list">
                                <h6 class="mb-2"><i class="fas fa-list-ul me-1"></i>Cambios Realizados:</h6>
                                
                                @if($activity->event === 'deleted')
                                    @if($activity->properties->has('old'))
                                        @foreach($activity->properties['old'] as $key => $value)
                                            @if(!in_array($key, ['updated_at', 'created_at', 'deleted_at', 'id']))
                                                <div class="change-item">
                                                    <strong class="me-2">{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                    <span class="old-value">{{ is_array($value) ? json_encode($value) : $value }}</span>
                                                    <i class="fas fa-trash-alt text-danger ms-2"></i>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="text-muted">No se registraron detalles de la eliminación</div>
                                    @endif
                                    
                                @elseif($activity->event === 'updated' || $activity->event === 'created')
                                    @foreach($activity->properties['attributes'] ?? [] as $key => $newValue)
                                        @if(!in_array($key, ['updated_at', 'created_at', 'deleted_at', 'id']))
                                            <div class="change-item">
                                                <strong class="me-2">{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                @if($activity->event === 'updated' && isset($activity->properties['old'][$key]))
                                                    <span class="old-value me-2">{{ is_array($activity->properties['old'][$key]) ? json_encode($activity->properties['old'][$key]) : $activity->properties['old'][$key] }}</span>
                                                    <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                                @endif
                                                <span class="new-value">{{ is_array($newValue) ? json_encode($newValue) : $newValue }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay actividades registradas</h4>
                    <p class="text-muted">Las actividades del sistema aparecerán aquí</p>
                </div>
            </div>
        @endforelse
    </div>
    <!-- Paginación Mejorada -->
    @if($projects->hasPages())
    <div class="mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        <span class="text-muted">
                            Mostrando {{ $projects->firstItem() }} - {{ $projects->lastItem() }} de {{ $projects->total() }} actividades
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        @if (!$projects->onFirstPage())
                            <a href="{{ $projects->previousPageUrl() }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-chevron-left me-1"></i>Anterior
                            </a>
                        @endif
                        
                        <ul class="custom-pagination mb-0">
                            @php
                                $start = max($projects->currentPage() - 2, 1);
                                $end = min($start + 4, $projects->lastPage());
                                $start = max($end - 4, 1);
                            @endphp
                            
                            @if($start > 1)
                                <li class="page-item">
                                    <a href="{{ $projects->url(1) }}" class="page-link">1</a>
                                </li>
                                @if($start > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                            @endif
                            
                            @for ($i = $start; $i <= $end; $i++)
                                <li class="page-item {{ ($projects->currentPage() == $i) ? 'active' : '' }}">
                                    <a href="{{ $projects->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            @if($end < $projects->lastPage())
                                @if($end < $projects->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a href="{{ $projects->url($projects->lastPage()) }}" class="page-link">{{ $projects->lastPage() }}</a>
                                </li>
                            @endif
                        </ul>
                        
                        @if ($projects->hasMorePages())
                            <a href="{{ $projects->nextPageUrl() }}" class="btn btn-outline-primary btn-sm ms-2">
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
                       
@endsection
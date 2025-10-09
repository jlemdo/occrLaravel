@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.form-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.section-title {
    color: #495057;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-floating {
    margin-bottom: 1rem;
}

.form-floating > label {
    font-weight: 500;
    color: #6c757d;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
}

.btn-update {
    background: #28a745;
    border: 1px solid #28a745;
    color: white;
    padding: 0.75rem 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-update:hover {
    background: #218838;
    border-color: #1e7e34;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    color: white;
}

.preview-section {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #90caf9;
}

.preview-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    text-align: center;
}

.day-preview {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    border-radius: 15px;
    padding: 1rem 1.5rem;
    margin: 1rem 0;
    display: inline-block;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.time-preview {
    background: linear-gradient(45deg, #0d6efd, #6f42c1);
    color: white;
    border-radius: 15px;
    padding: 1rem 1.5rem;
    margin: 1rem 0;
    display: inline-block;
    font-weight: 700;
}

.priority-preview {
    font-size: 2rem;
    font-weight: 700;
    color: #ffc107;
    margin: 1rem 0;
}

.helper-text {
    background: #fff3cd;
    color: #856404;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    border-left: 4px solid #ffc107;
}

.current-info {
    background: #d1ecf1;
    color: #0c5460;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    border-left: 4px solid #17a2b8;
}

.icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1rem;
}

.day-icon-large {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.time-icon-large {
    background: linear-gradient(45deg, #0d6efd, #6f42c1);
    color: white;
}
</style>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-9">
                <div class="card shadow-sm border-0 my-4">
                    <div class="card-header p-4 border-bottom" style="background: white; border: 1px solid #dee2e6; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-dark mb-0">
                                    @if(request('type') == 'day')
                                        <i class="fas fa-calendar-edit me-2"></i>Editar Día de Entrega
                                    @else
                                        <i class="fas fa-clock me-2"></i>Editar Horario de Entrega
                                    @endif
                                </h4>
                                <p class="text-muted mb-0 small">
                                    @if(request('type') == 'day')
                                        Modifica la configuración del día seleccionado
                                    @else
                                        Edita los detalles del horario de entrega
                                    @endif
                                </p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{URL::to('dslots')}}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4">

                            <!-- Información Actual -->
                            <div class="current-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>
                                        @if(request('type') == 'day')
                                            Editando día: {{$item->day_label}}
                                        @else
                                            Editando horario: {{$item->slot_label}}
                                        @endif
                                    </strong>
                                </div>
                                <p class="mb-0">
                                    @if(request('type') == 'day')
                                        Día configurado actualmente como: {{$item->day_name}} (Prioridad: {{$item->priority}}, Estado: {{$item->is_active ? 'Activo' : 'Inactivo'}})
                                    @else
                                        Horario de {{$item->start_time}} a {{$item->end_time}} (Prioridad: {{$item->priority}}, Estado: {{$item->is_active ? 'Activo' : 'Inactivo'}})
                                    @endif
                                </p>
                            </div>

                            <div class="row">
                                <!-- Formulario -->
                                <div class="col-md-8">
                                    @if(request('type') == 'day')
                                        <!-- FORMULARIO PARA EDITAR DÍA -->
                                        <form method="post" action="{{route('updatedslots')}}">
                                            @csrf
                                            <input type="hidden" name="type" value="day">
                                            <input type="hidden" name="id" value="{{$item->id}}">

                                            <!-- Información Básica -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-calendar text-primary"></i>Información del Día
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="day_name" name="day_name" required>
                                                                <option value="sunday" {{$item->day_name == 'sunday' ? 'selected' : ''}}>Domingo</option>
                                                                <option value="monday" {{$item->day_name == 'monday' ? 'selected' : ''}}>Lunes</option>
                                                                <option value="tuesday" {{$item->day_name == 'tuesday' ? 'selected' : ''}}>Martes</option>
                                                                <option value="wednesday" {{$item->day_name == 'wednesday' ? 'selected' : ''}}>Miércoles</option>
                                                                <option value="thursday" {{$item->day_name == 'thursday' ? 'selected' : ''}}>Jueves</option>
                                                                <option value="friday" {{$item->day_name == 'friday' ? 'selected' : ''}}>Viernes</option>
                                                                <option value="saturday" {{$item->day_name == 'saturday' ? 'selected' : ''}}>Sábado</option>
                                                            </select>
                                                            <label for="day_name">Día de la Semana</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="day_label" name="day_label" 
                                                                   value="{{old('day_label', $item->day_label)}}" required placeholder="Etiqueta">
                                                            <label for="day_label">Etiqueta (Mostrar en App)</label>
                                                            <small class="text-muted">Como aparecerá para los usuarios</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Configuración -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-cogs text-success"></i>Configuración
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="day_number" name="day_number" required>
                                                                <option value="1" {{$item->day_number == 1 ? 'selected' : ''}}>1 - Lunes</option>
                                                                <option value="2" {{$item->day_number == 2 ? 'selected' : ''}}>2 - Martes</option>
                                                                <option value="3" {{$item->day_number == 3 ? 'selected' : ''}}>3 - Miércoles</option>
                                                                <option value="4" {{$item->day_number == 4 ? 'selected' : ''}}>4 - Jueves</option>
                                                                <option value="5" {{$item->day_number == 5 ? 'selected' : ''}}>5 - Viernes</option>
                                                                <option value="6" {{$item->day_number == 6 ? 'selected' : ''}}>6 - Sábado</option>
                                                                <option value="7" {{$item->day_number == 7 ? 'selected' : ''}}>7 - Domingo</option>
                                                            </select>
                                                            <label for="day_number">Número del Día</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="priority" name="priority" 
                                                                   min="1" max="10" value="{{old('priority', $item->priority)}}" required>
                                                            <label for="priority">Prioridad</label>
                                                            <small class="text-muted">1 = Mayor prioridad</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="is_active" name="is_active">
                                                                <option value="1" {{$item->is_active ? 'selected' : ''}}>Activo</option>
                                                                <option value="0" {{!$item->is_active ? 'selected' : ''}}>Inactivo</option>
                                                            </select>
                                                            <label for="is_active">Estado</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-floating">
                                                    <textarea class="form-control" id="notes" name="notes" placeholder="Notas" style="height: 100px;">{{old('notes', $item->notes)}}</textarea>
                                                    <label for="notes">Notas Internas (Opcional)</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-update">
                                                    <i class="fas fa-calendar-check me-2"></i>Actualizar Día de Entrega
                                                </button>
                                            </div>
                                        </form>

                                    @else
                                        <!-- FORMULARIO PARA EDITAR HORARIO -->
                                        <form method="post" action="{{route('updatedslots')}}">
                                            @csrf
                                            <input type="hidden" name="type" value="slot">
                                            <input type="hidden" name="id" value="{{$item->id}}">

                                            <!-- Información Básica -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-clock text-primary"></i>Información del Horario
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="slot_name" name="slot_name" 
                                                                   value="{{old('slot_name', $item->slot_name)}}" required placeholder="Nombre del Horario">
                                                            <label for="slot_name">Nombre del Horario</label>
                                                            <small class="text-muted">Ej: 9am-1pm, Mañana</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="slot_label" name="slot_label" 
                                                                   value="{{old('slot_label', $item->slot_label)}}" required placeholder="Etiqueta">
                                                            <label for="slot_label">Etiqueta (Mostrar en App)</label>
                                                            <small class="text-muted">Como aparecerá para los usuarios</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Configuración de Horarios -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-hourglass-half text-warning"></i>Rango de Horario
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="time" class="form-control" id="start_time" name="start_time" 
                                                                   value="{{old('start_time', $item->start_time)}}" required>
                                                            <label for="start_time">Hora de Inicio</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="time" class="form-control" id="end_time" name="end_time" 
                                                                   value="{{old('end_time', $item->end_time)}}" required>
                                                            <label for="end_time">Hora de Fin</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Configuración Adicional -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-cogs text-success"></i>Configuración Adicional
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="priority_slot" name="priority" 
                                                                   min="1" max="10" value="{{old('priority', $item->priority)}}" required>
                                                            <label for="priority_slot">Prioridad</label>
                                                            <small class="text-muted">1 = Mayor prioridad</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="is_active_slot" name="is_active">
                                                                <option value="1" {{$item->is_active ? 'selected' : ''}}>Activo</option>
                                                                <option value="0" {{!$item->is_active ? 'selected' : ''}}>Inactivo</option>
                                                            </select>
                                                            <label for="is_active_slot">Estado</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-floating">
                                                    <textarea class="form-control" id="notes_slot" name="notes" placeholder="Notas" style="height: 100px;">{{old('notes', $item->notes)}}</textarea>
                                                    <label for="notes_slot">Notas Internas (Opcional)</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-update">
                                                    <i class="fas fa-clock me-2"></i>Actualizar Horario de Entrega
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>

                                <!-- Vista Previa -->
                                <div class="col-md-4">
                                    <div class="preview-section">
                                        <div class="text-center">
                                            @if(request('type') == 'day')
                                                <div class="icon-large day-icon-large">
                                                    <i class="fas fa-calendar-day"></i>
                                                </div>
                                                <h6 class="mb-3">Vista Previa del Día</h6>
                                                
                                                <div class="preview-card">
                                                    <div class="day-preview" id="day-preview">
                                                        <span id="preview-day-label">{{$item->day_label}}</span>
                                                    </div>
                                                    
                                                    <div class="priority-preview" id="priority-preview">
                                                        <i class="fas fa-sort-numeric-up"></i>
                                                        <span id="preview-priority">{{$item->priority}}</span>
                                                    </div>
                                                    
                                                    <small class="text-muted d-block mt-2" id="preview-status">
                                                        @if($item->is_active)
                                                            <i class="fas fa-check-circle text-success"></i> Estado: Activo
                                                        @else
                                                            <i class="fas fa-times-circle text-danger"></i> Estado: Inactivo
                                                        @endif
                                                    </small>
                                                </div>
                                            @else
                                                <div class="icon-large time-icon-large">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <h6 class="mb-3">Vista Previa del Horario</h6>
                                                
                                                <div class="preview-card">
                                                    <div class="time-preview" id="time-preview">
                                                        <span id="preview-time-label">{{$item->slot_label}}</span>
                                                    </div>
                                                    
                                                    <div class="text-muted mb-2" id="preview-time-range">
                                                        <i class="fas fa-hourglass-start me-1"></i>
                                                        <span id="preview-start">{{$item->start_time}}</span> - <span id="preview-end">{{$item->end_time}}</span>
                                                    </div>
                                                    
                                                    <div class="priority-preview" id="priority-preview-slot">
                                                        <i class="fas fa-sort-numeric-up"></i>
                                                        <span id="preview-priority-slot">{{$item->priority}}</span>
                                                    </div>
                                                    
                                                    <small class="text-muted d-block mt-2" id="preview-status-slot">
                                                        @if($item->is_active)
                                                            <i class="fas fa-check-circle text-success"></i> Estado: Activo
                                                        @else
                                                            <i class="fas fa-times-circle text-danger"></i> Estado: Inactivo
                                                        @endif
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Estado Actual -->
                                    <div class="form-section">
                                        <h6 class="section-title">
                                            <i class="fas fa-info text-info"></i>Información Actual
                                        </h6>
                                        <ul class="list-unstyled mb-0">
                                            @if(request('type') == 'day')
                                                <li class="mb-2">
                                                    <i class="fas fa-calendar text-primary me-2"></i>
                                                    <strong>Día:</strong> {{ucfirst($item->day_name)}}
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-sort-numeric-up text-warning me-2"></i>
                                                    <strong>Número:</strong> {{$item->day_number}}
                                                </li>
                                            @else
                                                <li class="mb-2">
                                                    <i class="fas fa-clock text-primary me-2"></i>
                                                    <strong>Horario:</strong> {{$item->start_time}} - {{$item->end_time}}
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-tag text-warning me-2"></i>
                                                    <strong>Nombre:</strong> {{$item->slot_name}}
                                                </li>
                                            @endif
                                            <li class="mb-2">
                                                <i class="fas fa-sort text-info me-2"></i>
                                                <strong>Prioridad:</strong> {{$item->priority}}
                                            </li>
                                            <li class="mb-0">
                                                <i class="fas {{$item->is_active ? 'fa-check-circle text-success' : 'fa-times-circle text-danger'}} me-2"></i>
                                                <strong>Estado:</strong> {{$item->is_active ? 'Activo' : 'Inactivo'}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
@if(request('type') == 'day')
// Vista previa para días
$(document).ready(function() {
    // Actualizar etiqueta del día
    $('#day_name, #day_label').on('change input', function() {
        var dayLabel = $('#day_label').val() || $('#day_name option:selected').text();
        $('#preview-day-label').text(dayLabel);
    });
    
    // Actualizar prioridad
    $('#priority').on('input', function() {
        var priority = $(this).val();
        $('#preview-priority').text(priority);
    });
    
    // Actualizar estado
    $('#is_active').on('change', function() {
        var isActive = $(this).val() === '1';
        var statusHtml = isActive 
            ? '<i class="fas fa-check-circle text-success"></i> Estado: Activo'
            : '<i class="fas fa-times-circle text-danger"></i> Estado: Inactivo';
        $('#preview-status').html(statusHtml);
    });
});
@else
// Vista previa para horarios
$(document).ready(function() {
    // Actualizar etiqueta del horario
    $('#slot_name, #slot_label').on('change input', function() {
        var slotLabel = $('#slot_label').val() || $('#slot_name').val();
        $('#preview-time-label').text(slotLabel);
    });
    
    // Actualizar rango de horario
    $('#start_time, #end_time').on('change', function() {
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();
        $('#preview-start').text(startTime);
        $('#preview-end').text(endTime);
    });
    
    // Actualizar prioridad
    $('#priority_slot').on('input', function() {
        var priority = $(this).val();
        $('#preview-priority-slot').text(priority);
    });
    
    // Actualizar estado
    $('#is_active_slot').on('change', function() {
        var isActive = $(this).val() === '1';
        var statusHtml = isActive 
            ? '<i class="fas fa-check-circle text-success"></i> Estado: Activo'
            : '<i class="fas fa-times-circle text-danger"></i> Estado: Inactivo';
        $('#preview-status-slot').html(statusHtml);
    });
});
@endif
</script>

@endsection
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

.btn-save {
    background: #0d6efd;
    border: 1px solid #0d6efd;
    color: white;
    padding: 0.75rem 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-save:hover {
    background: #0b5ed7;
    border-color: #0a58ca;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
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

.type-selector {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
}

.type-option {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 0.75rem;
    text-decoration: none;
    color: inherit;
    display: block;
}

.type-option:hover {
    border-color: #0d6efd;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
    color: inherit;
    text-decoration: none;
}

.type-option.active {
    border-color: #0d6efd;
    background: linear-gradient(45deg, #e3f2fd, #bbdefb);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
}

.type-badge {
    background: #0d6efd;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.type-day .type-badge {
    background: #28a745;
}

.type-time .type-badge {
    background: #0d6efd;
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
                                        <i class="fas fa-calendar-plus me-2"></i>Agregar Nuevo Día de Entrega
                                    @else
                                        <i class="fas fa-clock me-2"></i>Agregar Nuevo Horario de Entrega
                                    @endif
                                </h4>
                                <p class="text-muted mb-0 small">
                                    @if(request('type') == 'day')
                                        Configura un nuevo día disponible para entregas
                                    @else
                                        Define un nuevo horario de entrega
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

                            <!-- Selector de Tipo (si no hay parámetro) -->
                            @if(!request('type'))
                                <div class="type-selector">
                                    <h6 class="mb-3">
                                        <i class="fas fa-cogs me-2"></i>¿Qué deseas configurar?
                                    </h6>
                                    
                                    <a href="?type=day" class="type-option type-day">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">
                                                    <i class="fas fa-calendar-day me-2"></i>Día de Entrega
                                                </h6>
                                                <small class="text-muted">Configura qué días de la semana están disponibles</small>
                                            </div>
                                            <span class="type-badge">Días</span>
                                        </div>
                                    </a>
                                    
                                    <a href="?type=slot" class="type-option type-time">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">
                                                    <i class="fas fa-clock me-2"></i>Horario de Entrega
                                                </h6>
                                                <small class="text-muted">Define los horarios disponibles durante el día</small>
                                            </div>
                                            <span class="type-badge">Horarios</span>
                                        </div>
                                    </a>
                                </div>
                            @else

                            <!-- Texto de ayuda -->
                            <div class="helper-text">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>
                                        @if(request('type') == 'day')
                                            Configurando nuevo día de entrega
                                        @else
                                            Configurando nuevo horario de entrega
                                        @endif
                                    </strong>
                                </div>
                                <p class="mb-0">
                                    @if(request('type') == 'day')
                                        Define qué días de la semana están disponibles para realizar entregas. Puedes establecer la prioridad y agregar notas internas.
                                    @else
                                        Establece los horarios específicos disponibles durante los días configurados. Los usuarios podrán elegir estos horarios para sus entregas.
                                    @endif
                                </p>
                            </div>

                            <div class="row">
                                <!-- Formulario -->
                                <div class="col-md-8">
                                    @if(request('type') == 'day')
                                        <!-- FORMULARIO PARA AGREGAR DÍA -->
                                        <form method="post" action="{{route('adddslotsaction')}}">
                                            @csrf
                                            <input type="hidden" name="type" value="day">

                                            <!-- Información Básica -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-calendar text-primary"></i>Información del Día
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="day_name" name="day_name" required>
                                                                <option value="">Seleccionar día...</option>
                                                                <option value="sunday">Domingo</option>
                                                                <option value="monday">Lunes</option>
                                                                <option value="tuesday">Martes</option>
                                                                <option value="wednesday">Miércoles</option>
                                                                <option value="thursday">Jueves</option>
                                                                <option value="friday">Viernes</option>
                                                                <option value="saturday">Sábado</option>
                                                            </select>
                                                            <label for="day_name">Día de la Semana</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="day_label" name="day_label" placeholder="Etiqueta" required>
                                                            <label for="day_label">Etiqueta (Mostrar en App)</label>
                                                            <small class="text-muted">Ej: Miércoles, Viernes</small>
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
                                                                <option value="">Seleccionar...</option>
                                                                <option value="1">1 - Lunes</option>
                                                                <option value="2">2 - Martes</option>
                                                                <option value="3">3 - Miércoles</option>
                                                                <option value="4">4 - Jueves</option>
                                                                <option value="5">5 - Viernes</option>
                                                                <option value="6">6 - Sábado</option>
                                                                <option value="7">7 - Domingo</option>
                                                            </select>
                                                            <label for="day_number">Número del Día</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="priority" name="priority" min="1" max="10" value="1" required>
                                                            <label for="priority">Prioridad</label>
                                                            <small class="text-muted">1 = Mayor prioridad</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="is_active" name="is_active">
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select>
                                                            <label for="is_active">Estado Inicial</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-floating">
                                                    <textarea class="form-control" id="notes" name="notes" placeholder="Notas" style="height: 100px;"></textarea>
                                                    <label for="notes">Notas Internas (Opcional)</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-save">
                                                    <i class="fas fa-calendar-check me-2"></i>Guardar Día de Entrega
                                                </button>
                                            </div>
                                        </form>

                                    @else
                                        <!-- FORMULARIO PARA AGREGAR HORARIO -->
                                        <form method="post" action="{{route('adddslotsaction')}}">
                                            @csrf
                                            <input type="hidden" name="type" value="slot">

                                            <!-- Información Básica -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-clock text-primary"></i>Información del Horario
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="slot_name" name="slot_name" placeholder="Nombre del Horario" required>
                                                            <label for="slot_name">Nombre del Horario</label>
                                                            <small class="text-muted">Ej: 9am-1pm, Mañana</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="slot_label" name="slot_label" placeholder="Etiqueta" required>
                                                            <label for="slot_label">Etiqueta (Mostrar en App)</label>
                                                            <small class="text-muted">Ej: 9:00 AM - 1:00 PM</small>
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
                                                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                                                            <label for="start_time">Hora de Inicio</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="time" class="form-control" id="end_time" name="end_time" required>
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
                                                            <input type="number" class="form-control" id="priority_slot" name="priority" min="1" max="10" value="1" required>
                                                            <label for="priority_slot">Prioridad</label>
                                                            <small class="text-muted">1 = Mayor prioridad</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="is_active_slot" name="is_active">
                                                                <option value="1">Activo</option>
                                                                <option value="0">Inactivo</option>
                                                            </select>
                                                            <label for="is_active_slot">Estado Inicial</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-floating">
                                                    <textarea class="form-control" id="notes_slot" name="notes" placeholder="Notas" style="height: 100px;"></textarea>
                                                    <label for="notes_slot">Notas Internas (Opcional)</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Botón -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-save">
                                                    <i class="fas fa-clock me-2"></i>Guardar Horario de Entrega
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
                                                        <span id="preview-day-label">Selecciona un día</span>
                                                    </div>
                                                    
                                                    <div class="priority-preview" id="priority-preview">
                                                        <i class="fas fa-sort-numeric-up"></i>
                                                        <span id="preview-priority">1</span>
                                                    </div>
                                                    
                                                    <small class="text-muted d-block mt-2" id="preview-status">
                                                        <i class="fas fa-check-circle text-success"></i> Estado: Activo
                                                    </small>
                                                </div>
                                            @else
                                                <div class="icon-large time-icon-large">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <h6 class="mb-3">Vista Previa del Horario</h6>
                                                
                                                <div class="preview-card">
                                                    <div class="time-preview" id="time-preview">
                                                        <span id="preview-time-label">Configura el horario</span>
                                                    </div>
                                                    
                                                    <div class="text-muted mb-2" id="preview-time-range">
                                                        <i class="fas fa-hourglass-start me-1"></i>
                                                        <span id="preview-start">00:00</span> - <span id="preview-end">00:00</span>
                                                    </div>
                                                    
                                                    <div class="priority-preview" id="priority-preview-slot">
                                                        <i class="fas fa-sort-numeric-up"></i>
                                                        <span id="preview-priority-slot">1</span>
                                                    </div>
                                                    
                                                    <small class="text-muted d-block mt-2" id="preview-status-slot">
                                                        <i class="fas fa-check-circle text-success"></i> Estado: Activo
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Consejos -->
                                    <div class="form-section">
                                        <h6 class="section-title">
                                            <i class="fas fa-lightbulb text-warning"></i>Consejos
                                        </h6>
                                        <ul class="list-unstyled mb-0">
                                            @if(request('type') == 'day')
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    La prioridad determina el orden de presentación
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Puedes desactivar días temporalmente
                                                </li>
                                                <li class="mb-0">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Las notas son solo para uso interno
                                                </li>
                                            @else
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Define horarios realistas para las entregas
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Considera tiempo de preparación y traslado
                                                </li>
                                                <li class="mb-0">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Los horarios se muestran según la prioridad
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
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
        var dayLabel = $('#day_label').val() || $('#day_name option:selected').text() || 'Selecciona un día';
        if (dayLabel === 'Seleccionar día...') dayLabel = 'Selecciona un día';
        $('#preview-day-label').text(dayLabel);
    });
    
    // Actualizar prioridad
    $('#priority').on('input', function() {
        var priority = $(this).val() || '1';
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
@elseif(request('type') == 'slot')
// Vista previa para horarios
$(document).ready(function() {
    // Actualizar etiqueta del horario
    $('#slot_name, #slot_label').on('change input', function() {
        var slotLabel = $('#slot_label').val() || $('#slot_name').val() || 'Configura el horario';
        $('#preview-time-label').text(slotLabel);
    });
    
    // Actualizar rango de horario
    $('#start_time, #end_time').on('change', function() {
        var startTime = $('#start_time').val() || '00:00';
        var endTime = $('#end_time').val() || '00:00';
        $('#preview-start').text(startTime);
        $('#preview-end').text(endTime);
    });
    
    // Actualizar prioridad
    $('#priority_slot').on('input', function() {
        var priority = $(this).val() || '1';
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
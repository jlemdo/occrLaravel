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

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus {
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

.distance-preview {
    background: white;
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #1976d2;
    font-weight: 600;
    margin-bottom: 0.75rem;
    box-shadow: 0 2px 4px rgba(25, 118, 210, 0.2);
}

.amount-preview {
    font-size: 2rem;
    font-weight: 700;
    color: #2e7d32;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.helper-text {
    background: #fff3cd;
    color: #856404;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    border-left: 4px solid #ffc107;
}

.delivery-icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(45deg, #fff3cd, #ffeaa7);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #856404;
    font-size: 2rem;
    margin: 0 auto 1rem;
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
                                    <i class="fas fa-plus-circle me-2"></i>Agregar Tarifa de Entrega
                                </h4>
                                <p class="text-muted mb-0 small">Configura una nueva tarifa de entrega por distancia</p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{URL::to('delivery')}}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4">
                            
                            <!-- Texto de ayuda -->
                            <div class="helper-text">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>¿Cómo configurar las tarifas?</strong>
                                </div>
                                <p class="mb-0">
                                    Define la distancia (ej: "0-5 km", "5-10 km") y el costo de entrega correspondiente. 
                                    Estas tarifas se aplicarán automáticamente según la ubicación del cliente.
                                </p>
                            </div>

                            <form method="post" action="{{route('addfinancing')}}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <!-- Formulario -->
                                    <div class="col-md-6">
                                        <!-- Sección: Información de Tarifa -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-route text-primary"></i>Configuración de Tarifa
                                            </h5>
                                            
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="distance" name="distance" 
                                                       value="{{old('distance')}}" required placeholder="Distancia">
                                                <label for="distance">Distancia (ej: 0-5 km) *</label>
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" 
                                                       value="{{old('amount')}}" required placeholder="Monto">
                                                <label for="amount">Costo de Entrega ($) *</label>
                                            </div>
                                            
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-save">
                                                    <i class="fas fa-save me-2"></i>Guardar Tarifa
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Vista Previa -->
                                    <div class="col-md-6">
                                        <div class="preview-section">
                                            <div class="text-center">
                                                <div class="delivery-icon-large">
                                                    <i class="fas fa-truck"></i>
                                                </div>
                                                <h6 class="mb-3">Vista Previa de la Tarifa</h6>
                                                
                                                <div class="distance-preview" id="distance-preview">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span id="distance-text">Ingresa la distancia</span>
                                                </div>
                                                
                                                <div class="amount-preview" id="amount-preview">
                                                    <i class="fas fa-dollar-sign" style="font-size: 1.5rem;"></i>
                                                    <span id="amount-text">0.00</span>
                                                </div>
                                                <small class="text-muted d-block mt-2">Costo de entrega</small>
                                                
                                                <div class="mt-3 pt-3 border-top">
                                                    <small class="text-muted">
                                                        <i class="fas fa-lightbulb me-1"></i>
                                                        Esta tarifa se aplicará automáticamente a los pedidos
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Información adicional -->
                                        <div class="form-section">
                                            <h6 class="section-title">
                                                <i class="fas fa-chart-line text-success"></i>Consejos de Configuración
                                            </h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Usa rangos claros como "0-5 km", "5-10 km"
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Considera costos de combustible y tiempo
                                                </li>
                                                <li class="mb-0">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    Revisa tarifas de competencia regularmente
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
// Vista previa en tiempo real
$(document).ready(function() {
    // Actualizar vista previa de distancia
    $('#distance').on('input', function() {
        var distanceValue = $(this).val();
        if (distanceValue) {
            $('#distance-text').text(distanceValue);
        } else {
            $('#distance-text').text('Ingresa la distancia');
        }
    });
    
    // Actualizar vista previa de monto
    $('#amount').on('input', function() {
        var amountValue = parseFloat($(this).val());
        if (!isNaN(amountValue) && amountValue >= 0) {
            $('#amount-text').text(amountValue.toFixed(2));
        } else {
            $('#amount-text').text('0.00');
        }
    });
    
    // Validación del formulario
    $('form').on('submit', function(e) {
        var distance = $('#distance').val().trim();
        var amount = parseFloat($('#amount').val());
        
        if (!distance) {
            e.preventDefault();
            alert('Por favor ingresa la distancia');
            $('#distance').focus();
            return false;
        }
        
        if (isNaN(amount) || amount < 0) {
            e.preventDefault();
            alert('Por favor ingresa un monto válido');
            $('#amount').focus();
            return false;
        }
        
        // Mostrar confirmación
        return confirm('¿Deseas guardar esta tarifa de entrega?\n\nDistancia: ' + distance + '\nCosto: $' + amount.toFixed(2));
    });
});
</script>

@endsection
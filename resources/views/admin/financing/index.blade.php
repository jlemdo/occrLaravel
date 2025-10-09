@extends('layouts.app')
@section('section')

<!-- Estilos personalizados para el nuevo sistema -->
<style>
.shipping-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.shipping-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.config-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f8f9fa;
}

.amount-input-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.amount-input {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 1rem 1rem 1rem 3rem;
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
    width: 100%;
}

.amount-input:focus {
    border-color: #28a745;
    background: white;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.1);
    outline: none;
}

.currency-symbol {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.5rem;
    font-weight: 600;
    color: #28a745;
    z-index: 2;
}

.config-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border-left: 4px solid #28a745;
}

.config-title {
    color: #495057;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}


.btn-save {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
    color: white;
    padding: 0.875rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    border: 1px solid #dee2e6;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
}
</style>

<div class="mt-4">
    <!-- Header -->
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">📦 Sistema de Envío Gratis</h2>
            <p class="text-muted mb-0">Configura el monto mínimo para envío gratis y costo estándar</p>
        </div>
        <div class="col-auto">
            <!-- Badge eliminado -->
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value text-success">$@if($config){{ number_format($config->min_order_for_free_shipping, 0) }}@else 500 @endif</div>
            <div class="stat-label">Monto para Envío Gratis</div>
        </div>
        <div class="stat-card">
            <div class="stat-value text-primary">$@if($config){{ number_format($config->standard_shipping_fee, 0) }}@else 50 @endif</div>
            <div class="stat-label">Costo Estándar de Envío</div>
        </div>
        <!-- Card Estado eliminado -->
    </div>

    <!-- Formulario Principal -->
    <form action="{{ route('shipping.update') }}" method="POST" id="shipping-form">
        @csrf
        <div class="shipping-card">
            <div class="config-header">
                <h4 class="mb-0 d-flex align-items-center gap-2">
                    <i class="fas fa-cog text-primary"></i>
                    Configuración de Envío
                </h4>
                
                <!-- Toggle eliminado -->
            </div>

            <div class="row">
                <!-- Monto Mínimo para Envío Gratis -->
                <div class="col-md-6">
                    <div class="config-section">
                        <div class="config-title">
                            <i class="fas fa-gift text-success"></i>
                            Monto Mínimo para Envío Gratis
                        </div>
                        <div class="amount-input-group">
                            <span class="currency-symbol">$</span>
                            <input type="number" class="form-control amount-input" 
                                   name="min_order_for_free_shipping" 
                                   value="@if($config){{ $config->min_order_for_free_shipping }}@else 500 @endif"
                                   min="0" step="1" required>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Compras iguales o mayores a este monto tendrán envío gratis
                        </small>
                    </div>
                </div>

                <!-- Costo Estándar de Envío -->
                <div class="col-md-6">
                    <div class="config-section">
                        <div class="config-title">
                            <i class="fas fa-truck text-primary"></i>
                            Costo Estándar de Envío
                        </div>
                        <div class="amount-input-group">
                            <span class="currency-symbol">$</span>
                            <input type="number" class="form-control amount-input" 
                                   name="standard_shipping_fee" 
                                   value="@if($config){{ $config->standard_shipping_fee }}@else 50 @endif"
                                   min="0" step="0.01" required>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Costo fijo para compras menores al monto mínimo
                        </small>
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    <i class="fas fa-align-left text-secondary"></i>
                    Descripción del Sistema
                </label>
                <textarea class="form-control" name="description" rows="3" 
                          placeholder="Describe cómo funciona tu sistema de envío...">@if($config){{ $config->description }}@else Envío gratis en compras mayores a $500, de lo contrario costo fijo de $50 @endif</textarea>
            </div>

            <!-- Botón Guardar -->
            <div class="text-center">
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i>
                    Guardar Configuración
                </button>
            </div>
        </div>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Actualizar stats en tiempo real
    document.querySelector('input[name="min_order_for_free_shipping"]').addEventListener('input', function() {
        document.querySelector('.stat-value.text-success').textContent = '$' + parseInt(this.value).toLocaleString();
    });
    
    document.querySelector('input[name="standard_shipping_fee"]').addEventListener('input', function() {
        document.querySelector('.stat-value.text-primary').textContent = '$' + parseInt(this.value).toLocaleString();
    });
    
    // Confirmación antes de guardar
    document.getElementById('shipping-form').addEventListener('submit', function(e) {
        const minAmount = parseFloat(document.querySelector('input[name="min_order_for_free_shipping"]').value);
        const shippingCost = parseFloat(document.querySelector('input[name="standard_shipping_fee"]').value);
        
        if (!confirm(`¿Confirmar nueva configuración?\n\n• Envío gratis: $${minAmount}\n• Costo estándar: $${shippingCost}\n\nEsta configuración afectará a todos los pedidos futuros.`)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
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

.system-selector {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
}

.system-option {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 0.75rem;
}

.system-option:hover {
    border-color: #0d6efd;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
}

.system-option.active {
    border-color: #0d6efd;
    background: linear-gradient(45deg, #e3f2fd, #bbdefb);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
}

.system-badge {
    background: #0d6efd;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.system-1 .system-badge {
    background: #ff9800;
}

.system-2 .system-badge {
    background: #4caf50;
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

.coupon-preview {
    background: linear-gradient(45deg, #ff9800, #ff6f00);
    color: white;
    border-radius: 15px;
    padding: 1rem 1.5rem;
    margin: 1rem 0;
    display: inline-block;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.promotion-preview {
    background: linear-gradient(45deg, #4caf50, #2e7d32);
    color: white;
    border-radius: 15px;
    padding: 1rem 1.5rem;
    margin: 1rem 0;
    display: inline-block;
    font-weight: 700;
}

.discount-preview {
    font-size: 2rem;
    font-weight: 700;
    color: #2e7d32;
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
                                    <i class="fas fa-edit me-2"></i>Editar Cupón/Promoción
                                </h4>
                                <p class="text-muted mb-0 small">Modifica la configuración del descuento</p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{URL::to('promotion')}}" class="btn btn-secondary btn-sm">
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
                                    <strong>Editando: {{$proposals->name}}</strong>
                                </div>
                                <p class="mb-0">
                                    Puedes cambiar el tipo de sistema, los valores y configuraciones. 
                                    Los cambios se aplicarán inmediatamente después de guardar.
                                </p>
                            </div>

                            <form method="post" action="{{URL::to('updateproposalbattery')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$proposals->id}}">
                                
                                <div class="row">
                                    <!-- Formulario -->
                                    <div class="col-md-8">
                                        <!-- Selector de Sistema -->
                                        <div class="system-selector">
                                            <h6 class="mb-3">
                                                <i class="fas fa-cogs me-2"></i>Seleccionar Sistema de Descuento
                                            </h6>
                                            
                                            <div class="system-option system-1 {{$proposals->is_coupon ? 'active' : ''}}" onclick="selectSystem(1)">
                                                <input type="radio" name="is_coupon" id="system1" value="1" 
                                                       {{$proposals->is_coupon ? 'checked' : ''}} style="display: none;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <i class="fas fa-ticket-alt me-2"></i>Sistema 1: Cupones Ecommerce
                                                        </h6>
                                                        <small class="text-muted">Códigos únicos, fechas de validez, uso controlado</small>
                                                    </div>
                                                    <span class="system-badge">Cupones</span>
                                                </div>
                                            </div>
                                            
                                            <div class="system-option system-2 {{!$proposals->is_coupon ? 'active' : ''}}" onclick="selectSystem(0)">
                                                <input type="radio" name="is_coupon" id="system2" value="0" 
                                                       {{!$proposals->is_coupon ? 'checked' : ''}} style="display: none;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">
                                                            <i class="fas fa-percentage me-2"></i>Sistema 2: Promociones Permanentes
                                                        </h6>
                                                        <small class="text-muted">Descuentos automáticos, usuarios específicos o globales</small>
                                                    </div>
                                                    <span class="system-badge">Promociones</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Información Básica -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-info-circle text-primary"></i>Información Básica
                                            </h5>
                                            
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name" name="name" 
                                                       value="{{old('name', $proposals->name)}}" required placeholder="Nombre">
                                                <label for="name">Nombre del Descuento *</label>
                                            </div>
                                            
                                            <!-- Código de cupón (solo para Sistema 1) -->
                                            <div class="form-floating" id="coupon_code_field">
                                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" 
                                                       value="{{old('coupon_code', $proposals->coupon_code)}}" placeholder="Código de Cupón" 
                                                       style="text-transform: uppercase;">
                                                <label for="coupon_code">Código de Cupón *</label>
                                                <small class="text-muted">Solo letras, números y guiones</small>
                                            </div>
                                        </div>

                                        <!-- Fechas de Validez (solo para Sistema 1) -->
                                        <div class="form-section" id="dates_section">
                                            <h5 class="section-title">
                                                <i class="fas fa-calendar-alt text-warning"></i>Período de Validez
                                            </h5>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="from" name="from" 
                                                               value="{{old('from', $proposals->from)}}" placeholder="Fecha Inicio">
                                                        <label for="from">Fecha de Inicio</label>
                                                        <small class="text-muted">Dejar vacío = activo inmediatamente</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" id="to" name="to" 
                                                               value="{{old('to', $proposals->to)}}" placeholder="Fecha Fin">
                                                        <label for="to">Fecha de Finalización</label>
                                                        <small class="text-muted">Dejar vacío = sin expiración</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuración del Descuento -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-calculator text-success"></i>Configuración del Descuento
                                            </h5>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <select class="form-control" id="discount_type" name="discount_type" required>
                                                            <option value="percentage" {{($proposals->discount_type ?? 'percentage') == 'percentage' ? 'selected' : ''}}>Porcentaje (%)</option>
                                                            <option value="fixed" {{($proposals->discount_type ?? 'percentage') == 'fixed' ? 'selected' : ''}}>Cantidad Fija ($)</option>
                                                        </select>
                                                        <label for="discount_type">Tipo de Descuento</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" 
                                                               value="{{old('discount', $proposals->discount)}}" required min="0" placeholder="Descuento">
                                                        <label for="discount" id="discount_label">Valor del Descuento</label>
                                                        <small class="text-muted" id="discount_hint">Ingresa el valor</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="minimum_amount" name="minimum_amount"
                                                               value="{{old('minimum_amount', $proposals->minimum_amount ?? 0)}}" min="0" placeholder="Monto Mínimo">
                                                        <label for="minimum_amount">Monto Mínimo ($)</label>
                                                        <small class="text-muted">0 = sin mínimo de compra</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Aplicar a (Solo para Cupones - Sistema 1) -->
                                            <div class="row" id="applies_to_field">
                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <select name="applies_to" id="applies_to" class="form-control" required>
                                                            <option value="total" {{($proposals->applies_to ?? 'total') == 'total' ? 'selected' : ''}}>Precio Total del Pedido</option>
                                                            <option value="shipping" {{($proposals->applies_to ?? 'total') == 'shipping' ? 'selected' : ''}}>Solo Costo de Envío</option>
                                                        </select>
                                                        <label for="applies_to">Aplicar Descuento A *</label>
                                                    </div>
                                                    <small class="form-text text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        <strong>Total:</strong> El descuento se aplica al precio total del pedido.
                                                        <strong>Envío:</strong> El descuento se aplica solo al costo de envío (puede ser envío gratis con 100%).
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuración de Promoción (solo para Sistema 2) -->
                                        <div class="form-section" id="promotion_section">
                                            <h5 class="section-title">
                                                <i class="fas fa-users text-info"></i>Alcance de la Promoción
                                            </h5>
                                            
                                            <div class="form-floating">
                                                <select class="form-control" id="type" name="type">
                                                    <option value="Global" {{$proposals->type == 'Global' ? 'selected' : ''}}>Todos los usuarios</option>
                                                    <option value="Individual" {{$proposals->type == 'Individual' ? 'selected' : ''}}>Usuarios específicos</option>
                                                    <option value="Birthday" {{$proposals->type == 'Birthday' ? 'selected' : ''}}>Cumpleañeros del mes</option>
                                                    <option value="Guest" {{$proposals->type == 'Guest' ? 'selected' : ''}}>Usuarios Guest</option>
                                                    <option value="Normal" {{$proposals->type == 'Normal' ? 'selected' : ''}}>Usuarios Normales</option>
                                                    <option value="Google" {{$proposals->type == 'Google' ? 'selected' : ''}}>Usuarios Google</option>
                                                    <option value="Apple" {{$proposals->type == 'Apple' ? 'selected' : ''}}>Usuarios Apple</option>
                                                </select>
                                                <label for="type">Aplicar Descuento A</label>
                                                <small class="text-muted">Global = automático para todos</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Botón de Actualizar -->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-update" id="update_btn">
                                                <i class="fas fa-save me-2"></i>Actualizar Descuento
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Vista Previa -->
                                    <div class="col-md-4">
                                        <div class="preview-section">
                                            <div class="text-center">
                                                <h6 class="mb-3">
                                                    <i class="fas fa-eye me-2"></i>Vista Previa
                                                </h6>
                                                
                                                <div class="preview-card">
                                                    <div id="preview-display">
                                                        <!-- Vista previa dinámica -->
                                                        <div class="coupon-preview" id="coupon-preview">
                                                            <div id="preview-name">{{$proposals->name}}</div>
                                                            <div id="preview-code">{{$proposals->coupon_code}}</div>
                                                        </div>
                                                        
                                                        <div class="promotion-preview" id="promotion-preview" style="display: none;">
                                                            <div id="preview-name-promo">{{$proposals->name}}</div>
                                                        </div>
                                                        
                                                        <div class="discount-preview" id="preview-discount">
                                                            @if(($proposals->discount_type ?? 'percentage') == 'percentage')
                                                                {{$proposals->discount}}%
                                                            @else
                                                                ${{number_format($proposals->discount, 2)}}
                                                            @endif
                                                        </div>
                                                        
                                                        @if($proposals->minimum_amount > 0)
                                                            <small class="text-muted d-block mt-2">
                                                                Mínimo: ${{number_format($proposals->minimum_amount, 2)}}
                                                            </small>
                                                        @endif
                                                        
                                                        @if($proposals->from || $proposals->to)
                                                            <div class="mt-3 pt-3 border-top">
                                                                <small class="text-muted">
                                                                    @if($proposals->from)
                                                                        Desde: {{date('d/m/Y', strtotime($proposals->from))}}
                                                                    @endif
                                                                    @if($proposals->to)
                                                                        <br>Hasta: {{date('d/m/Y', strtotime($proposals->to))}}
                                                                    @endif
                                                                </small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Estado Actual -->
                                        <div class="form-section">
                                            <h6 class="section-title">
                                                <i class="fas fa-info text-info"></i>Estado Actual
                                            </h6>
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-2">
                                                    <i class="fas fa-tag text-primary me-2"></i>
                                                    <strong>Tipo:</strong> {{$proposals->is_coupon ? 'Cupón' : 'Promoción'}}
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-calendar text-warning me-2"></i>
                                                    <strong>Creado:</strong> {{$proposals->created_at->format('d/m/Y H:i')}}
                                                </li>
                                                @if($proposals->type)
                                                <li class="mb-0">
                                                    <i class="fas fa-users text-success me-2"></i>
                                                    <strong>Alcance:</strong> {{$proposals->type}}
                                                </li>
                                                @endif
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
// Selección de sistema
function selectSystem(systemValue) {
    // Actualizar radio buttons
    document.querySelector('input[value="' + systemValue + '"]').checked = true;
    
    // Actualizar clases visuales
    document.querySelectorAll('.system-option').forEach(option => {
        option.classList.remove('active');
    });
    
    if (systemValue === 1) {
        document.querySelector('.system-1').classList.add('active');
    } else {
        document.querySelector('.system-2').classList.add('active');
    }
    
    toggleSystemFields();
}

function toggleSystemFields() {
    const isCoupon = document.querySelector('input[name="is_coupon"]:checked').value === '1';
    const updateBtn = document.getElementById('update_btn');

    // Campos específicos del Sistema 1 (Cupones)
    const couponCodeField = document.getElementById('coupon_code_field');
    const datesSection = document.getElementById('dates_section');
    const appliesToField = document.getElementById('applies_to_field');
    const promotionSection = document.getElementById('promotion_section');

    // Vista previa
    const couponPreview = document.getElementById('coupon-preview');
    const promotionPreview = document.getElementById('promotion-preview');

    if (isCoupon) {
        // Mostrar campos de cupón
        couponCodeField.style.display = 'block';
        datesSection.style.display = 'block';
        appliesToField.style.display = 'block';
        promotionSection.style.display = 'none';

        // Mostrar vista previa de cupón
        couponPreview.style.display = 'block';
        promotionPreview.style.display = 'none';

        // Hacer required el código de cupón
        document.getElementById('coupon_code').required = true;

        // Actualizar botón
        updateBtn.innerHTML = '<i class="fas fa-ticket-alt me-2"></i>Actualizar Cupón';
    } else {
        // Ocultar campos de cupón
        couponCodeField.style.display = 'none';
        datesSection.style.display = 'none';
        appliesToField.style.display = 'none';
        promotionSection.style.display = 'block';

        // Mostrar vista previa de promoción
        couponPreview.style.display = 'none';
        promotionPreview.style.display = 'block';

        // No requerir código de cupón
        document.getElementById('coupon_code').required = false;

        // Actualizar botón
        updateBtn.innerHTML = '<i class="fas fa-percentage me-2"></i>Actualizar Promoción';
    }
}

// Vista previa en tiempo real
$(document).ready(function() {
    // Actualizar preview del nombre
    $('#name').on('input', function() {
        var nameValue = $(this).val() || 'Nombre del descuento';
        $('#preview-name, #preview-name-promo').text(nameValue);
    });
    
    // Actualizar preview del código
    $('#coupon_code').on('input', function() {
        var codeValue = $(this).val().toUpperCase();
        $('#preview-code').text(codeValue || 'CODIGO');
        // Convertir a mayúsculas automáticamente
        $(this).val(codeValue.replace(/[^A-Z0-9-]/g, ''));
    });
    
    // Actualizar preview del descuento
    function updateDiscountPreview() {
        var discountType = $('#discount_type').val();
        var discountValue = parseFloat($('#discount').val()) || 0;
        var previewText = '';
        
        if (discountType === 'percentage') {
            previewText = discountValue + '%';
            $('#discount_label').text('Descuento (%)');
            $('#discount_hint').text('Entre 0 y 100');
            $('#discount').attr('max', '100');
        } else {
            previewText = '$' + discountValue.toFixed(2);
            $('#discount_label').text('Descuento ($)');
            $('#discount_hint').text('Cantidad en pesos');
            $('#discount').attr('max', '999999');
        }
        
        $('#preview-discount').text(previewText);
    }
    
    $('#discount_type, #discount').on('change input', updateDiscountPreview);
    
    // Validación del formulario
    $('form').on('submit', function(e) {
        var isCoupon = $('input[name="is_coupon"]:checked').val() === '1';
        var name = $('#name').val().trim();
        var discount = parseFloat($('#discount').val());
        
        if (!name) {
            e.preventDefault();
            alert('Por favor ingresa el nombre del descuento');
            $('#name').focus();
            return false;
        }
        
        if (isCoupon) {
            var couponCode = $('#coupon_code').val().trim();
            if (!couponCode) {
                e.preventDefault();
                alert('Por favor ingresa el código del cupón');
                $('#coupon_code').focus();
                return false;
            }
        }
        
        if (isNaN(discount) || discount <= 0) {
            e.preventDefault();
            alert('Por favor ingresa un valor de descuento válido');
            $('#discount').focus();
            return false;
        }
        
        // Confirmación
        var systemType = isCoupon ? 'cupón' : 'promoción';
        return confirm('¿Deseas actualizar este ' + systemType + '?\n\nNombre: ' + name + '\nDescuento: ' + $('#preview-discount').text());
    });
    
    // Inicializar estado
    toggleSystemFields();
    updateDiscountPreview();
});
</script>

@endsection
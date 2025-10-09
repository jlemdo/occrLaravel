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

.system-selector {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #90caf9;
}

.system-option {
    background: white;
    border-radius: 12px;
    padding: 1rem;
    margin: 0.5rem 0;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    cursor: pointer;
}

.system-option:hover {
    border-color: #2196f3;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.15);
}

.system-option.selected {
    border-color: #2196f3;
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
}

.system-option input[type="radio"] {
    margin-right: 0.75rem;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    padding: 0.75rem;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
}

.form-floating > label {
    font-weight: 500;
    color: #6c757d;
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
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-save:hover {
    background: #0b5ed7;
    border-color: #0a58ca;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    color: white;
}

.preview-section {
    position: sticky;
    top: 2rem;
}

.coupon-preview {
    background: linear-gradient(135deg, #fff8e1 0%, #fffde7 100%);
    border: 2px dashed #ff9800;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
}

.coupon-preview::before,
.coupon-preview::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.coupon-preview::before {
    left: -10px;
}

.coupon-preview::after {
    right: -10px;
}

.promotion-preview {
    background: linear-gradient(135deg, #e8f5e8 0%, #f1f8e9 100%);
    border: 2px solid #4caf50;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 1.5rem;
}

.preview-code {
    background: #ff9800;
    color: white;
    font-size: 1.2rem;
    font-weight: 700;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 1rem;
    display: inline-block;
}

.preview-discount {
    font-size: 3rem;
    font-weight: 800;
    color: #2e7d32;
    line-height: 1;
    margin: 1rem 0;
}

.preview-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1rem;
}

.coupon-icon {
    background: linear-gradient(45deg, #fff3e0, #ffe0b2);
    color: #ef6c00;
}

.promotion-icon {
    background: linear-gradient(45deg, #e8f5e8, #c8e6c9);
    color: #388e3c;
}

.helper-text {
    background: #fff3cd;
    color: #856404;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    border-left: 4px solid #ffc107;
}

.field-hidden {
    display: none;
    opacity: 0;
    transition: all 0.3s ease;
}

.field-visible {
    display: block;
    opacity: 1;
}

.tips-section {
    background: linear-gradient(135deg, #e8f5e8 0%, #f1f8e9 100%);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #c8e6c9;
}

.tip-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    color: #2e7d32;
}

.tip-item:last-child {
    margin-bottom: 0;
}

.tip-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #4caf50;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    font-size: 0.8rem;
    flex-shrink: 0;
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
                                    <i class="fas fa-plus-circle me-2"></i>Crear Nueva Promoción
                                </h4>
                                <p class="text-muted mb-0 small">Configura cupones de descuento o promociones automáticas</p>
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
                                    <strong>¿Cuál es la diferencia?</strong>
                                </div>
                                <p class="mb-0">
                                    <strong>Sistema 1 (Cupones):</strong> Códigos que los clientes ingresan manualmente durante el checkout.<br>
                                    <strong>Sistema 2 (Promociones):</strong> Descuentos automáticos que se aplican según criterios específicos.
                                </p>
                            </div>

                            <form method="post" action="{{route('addproposalbatteryaction')}}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <!-- Formulario -->
                                    <div class="col-md-7">
                                        <!-- Selector de Sistema -->
                                        <div class="system-selector">
                                            <h5 class="mb-3 text-center fw-bold">
                                                <i class="fas fa-cogs me-2"></i>Selecciona el Tipo de Sistema
                                            </h5>
                                            
                                            <div class="system-option" onclick="selectSystem(1)">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input" type="radio" name="is_coupon" id="system1" value="1" checked>
                                                    <div>
                                                        <h6 class="mb-1 fw-semibold">
                                                            <i class="fas fa-ticket-alt text-warning me-2"></i>
                                                            Sistema 1: Cupón con Código
                                                        </h6>
                                                        <small class="text-muted">
                                                            Los clientes ingresan un código durante el checkout. Ideal para campañas específicas.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="system-option" onclick="selectSystem(2)">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input" type="radio" name="is_coupon" id="system2" value="0">
                                                    <div>
                                                        <h6 class="mb-1 fw-semibold">
                                                            <i class="fas fa-percent text-success me-2"></i>
                                                            Sistema 2: Promoción Automática
                                                        </h6>
                                                        <small class="text-muted">
                                                            Descuentos que se aplican automáticamente según criterios. Ideal para ofertas permanentes.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Información Básica -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-edit text-primary"></i>Información Básica
                                            </h5>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="name" name="name" 
                                                               value="{{old('name')}}" required placeholder="Nombre">
                                                        <label for="name">Nombre de la Promoción *</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6" id="coupon_code_field">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" 
                                                               value="{{old('coupon_code')}}" placeholder="Código" style="text-transform: uppercase;">
                                                        <label for="coupon_code">Código de Cupón *</label>
                                                    </div>
                                                    <small class="form-text text-muted">Solo letras, números y guiones. Se convertirá a mayúsculas.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuración de Descuento -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-calculator text-success"></i>Configuración de Descuento
                                            </h5>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <select name="discount_type" id="discount_type" class="form-control" required>
                                                            <option value="percentage" selected>Porcentaje (%)</option>
                                                            <option value="fixed">Cantidad Fija ($)</option>
                                                        </select>
                                                        <label for="discount_type">Tipo de Descuento</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" step="0.01" id="discount" class="form-control" 
                                                               required name="discount" value="{{old('discount')}}" min="0" max="100">
                                                        <label for="discount" id="discount_label">Descuento (%) *</label>
                                                    </div>
                                                    <small class="form-text text-muted" id="discount_hint">Entre 0 y 100</small>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" step="0.01" id="minimum_amount" class="form-control" 
                                                               name="minimum_amount" value="{{old('minimum_amount', 0)}}" min="0">
                                                        <label for="minimum_amount">Monto Mínimo ($)</label>
                                                    </div>
                                                    <small class="form-text text-muted">0 = sin mínimo</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fechas de Validez (Solo Cupones) -->
                                        <div class="form-section" id="dates_section">
                                            <h5 class="section-title">
                                                <i class="fas fa-calendar-alt text-warning"></i>Fechas de Validez
                                            </h5>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" id="from" class="form-control" name="from" value="{{old('from')}}">
                                                        <label for="from">Fecha de Inicio</label>
                                                    </div>
                                                    <small class="form-text text-muted">Dejar vacío = activo inmediatamente</small>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" id="to" class="form-control" name="to" value="{{old('to')}}">
                                                        <label for="to">Fecha de Finalización</label>
                                                    </div>
                                                    <small class="form-text text-muted">Dejar vacío = sin expiración</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuración de Promoción (Solo Promociones) -->
                                        <div class="form-section field-hidden" id="promotion_section">
                                            <h5 class="section-title">
                                                <i class="fas fa-users text-info"></i>Alcance de la Promoción
                                            </h5>
                                            
                                            <div class="form-floating mb-3">
                                                <select name="type" class="form-control">
                                                    <option value="Global">Todos los usuarios</option>
                                                    <option value="Individual">Usuarios específicos</option>
                                                    <option value="Birthday">Cumpleañeros del mes</option>
                                                    <option value="Guest">Usuarios Guest</option>
                                                    <option value="Normal">Usuarios Normales</option>
                                                    <option value="Google">Usuarios Google</option>
                                                    <option value="Apple">Usuarios Apple</option>
                                                </select>
                                                <label for="type">Aplicar A</label>
                                            </div>
                                            <small class="form-text text-muted">Global se aplica automáticamente a todos los pedidos</small>
                                        </div>

                                        <!-- Botón de Guardar -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-save" id="save_btn">
                                                <i class="fas fa-save me-2"></i>Crear Cupón
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Vista Previa -->
                                    <div class="col-md-5">
                                        <div class="preview-section">
                                            <!-- Preview del Cupón/Promoción -->
                                            <div id="coupon_preview" class="coupon-preview">
                                                <div class="preview-icon coupon-icon">
                                                    <i class="fas fa-ticket-alt"></i>
                                                </div>
                                                <h6 class="mb-2">Vista Previa del Cupón</h6>
                                                <div class="preview-code" id="code_preview">INGRESA CÓDIGO</div>
                                                <div class="preview-discount" id="discount_preview">
                                                    <span id="discount_value">0</span>
                                                    <span id="discount_symbol">%</span>
                                                </div>
                                                <h5 id="name_preview" class="fw-bold text-dark">Nombre de la promoción</h5>
                                                <div class="mt-3 pt-3 border-top">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Mínimo: $<span id="minimum_preview">0</span>
                                                    </small>
                                                </div>
                                            </div>
                                            
                                            <div id="promotion_preview" class="promotion-preview field-hidden">
                                                <div class="preview-icon promotion-icon">
                                                    <i class="fas fa-percent"></i>
                                                </div>
                                                <h6 class="mb-2">Vista Previa de la Promoción</h6>
                                                <div class="preview-discount" id="discount_preview_2">
                                                    <span id="discount_value_2">0</span>
                                                    <span id="discount_symbol_2">%</span>
                                                </div>
                                                <h5 id="name_preview_2" class="fw-bold text-dark">Nombre de la promoción</h5>
                                                <div class="mt-3 pt-3 border-top">
                                                    <small class="text-muted">
                                                        <i class="fas fa-magic me-1"></i>
                                                        Se aplica automáticamente
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- Consejos -->
                                            <div class="tips-section">
                                                <h6 class="section-title mb-3">
                                                    <i class="fas fa-lightbulb text-warning"></i>Consejos de Configuración
                                                </h6>
                                                <div class="tip-item">
                                                    <div class="tip-icon">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <span>Usa códigos memorables para cupones</span>
                                                </div>
                                                <div class="tip-item">
                                                    <div class="tip-icon">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <span>Establece fechas límite para crear urgencia</span>
                                                </div>
                                                <div class="tip-item">
                                                    <div class="tip-icon">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <span>Considera montos mínimos para proteger márgenes</span>
                                                </div>
                                            </div>
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
// Función para seleccionar sistema
function selectSystem(system) {
    document.getElementById('system' + system).checked = true;
    toggleSystemFields();
    updateSystemSelection();
}

// Actualizar selección visual
function updateSystemSelection() {
    document.querySelectorAll('.system-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    const selectedRadio = document.querySelector('input[name="is_coupon"]:checked');
    selectedRadio.closest('.system-option').classList.add('selected');
}

// Toggle de campos según sistema
function toggleSystemFields() {
    const isCoupon = document.querySelector('input[name="is_coupon"]:checked').value === '1';
    
    // Campos de cupón
    const couponFields = ['coupon_code_field', 'dates_section', 'coupon_preview'];
    couponFields.forEach(id => {
        const field = document.getElementById(id);
        if (isCoupon) {
            field.classList.remove('field-hidden');
            field.classList.add('field-visible');
        } else {
            field.classList.add('field-hidden');
            field.classList.remove('field-visible');
        }
    });
    
    // Campos de promoción
    const promotionFields = ['promotion_section', 'promotion_preview'];
    promotionFields.forEach(id => {
        const field = document.getElementById(id);
        if (!isCoupon) {
            field.classList.remove('field-hidden');
            field.classList.add('field-visible');
        } else {
            field.classList.add('field-hidden');
            field.classList.remove('field-visible');
        }
    });
    
    // Actualizar botón y required
    const saveBtn = document.getElementById('save_btn');
    const couponCodeInput = document.getElementById('coupon_code');
    
    if (isCoupon) {
        saveBtn.innerHTML = '<i class="fas fa-ticket-alt me-2"></i>Crear Cupón';
        couponCodeInput.required = true;
    } else {
        saveBtn.innerHTML = '<i class="fas fa-percent me-2"></i>Crear Promoción';
        couponCodeInput.required = false;
    }
}

// Actualizar etiquetas de descuento
function updateDiscountLabel() {
    const discountType = document.getElementById('discount_type').value;
    const label = document.getElementById('discount_label');
    const hint = document.getElementById('discount_hint');
    const input = document.getElementById('discount');
    
    if (discountType === 'percentage') {
        label.textContent = 'Descuento (%) *';
        hint.textContent = 'Entre 0 y 100';
        input.max = '100';
        document.getElementById('discount_symbol').textContent = '%';
        document.getElementById('discount_symbol_2').textContent = '%';
    } else {
        label.textContent = 'Descuento ($) *';
        hint.textContent = 'Cantidad en pesos';
        input.max = '999999';
        document.getElementById('discount_symbol').innerHTML = '<i class="fas fa-dollar-sign" style="font-size: 2.5rem;"></i>';
        document.getElementById('discount_symbol_2').innerHTML = '<i class="fas fa-dollar-sign" style="font-size: 2.5rem;"></i>';
    }
    
    updatePreview();
}

// Actualizar vista previa en tiempo real
function updatePreview() {
    const name = document.getElementById('name').value || 'Nombre de la promoción';
    const code = document.getElementById('coupon_code').value || 'CÓDIGO';
    const discount = document.getElementById('discount').value || '0';
    const minimum = document.getElementById('minimum_amount').value || '0';
    
    // Actualizar nombres
    document.getElementById('name_preview').textContent = name;
    document.getElementById('name_preview_2').textContent = name;
    
    // Actualizar código
    document.getElementById('code_preview').textContent = code;
    
    // Actualizar descuentos
    document.getElementById('discount_value').textContent = discount;
    document.getElementById('discount_value_2').textContent = discount;
    
    // Actualizar mínimo
    document.getElementById('minimum_preview').textContent = minimum;
}

// Event listeners
$(document).ready(function() {
    // Inicializar
    toggleSystemFields();
    updateSystemSelection();
    updateDiscountLabel();
    updatePreview();
    
    // Listeners para radio buttons
    $('input[name="is_coupon"]').change(function() {
        toggleSystemFields();
        updateSystemSelection();
    });
    
    // Listener para tipo de descuento
    $('#discount_type').change(updateDiscountLabel);
    
    // Listeners para vista previa
    $('#name, #coupon_code, #discount, #minimum_amount').on('input', updatePreview);
    
    // Convertir código a mayúsculas
    $('#coupon_code').on('input', function() {
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
        updatePreview();
    });
    
    // Validación del formulario
    $('form').on('submit', function(e) {
        const isCoupon = document.querySelector('input[name="is_coupon"]:checked').value === '1';
        const name = $('#name').val().trim();
        const code = $('#coupon_code').val().trim();
        const discount = parseFloat($('#discount').val());
        
        if (!name) {
            e.preventDefault();
            alert('Por favor ingresa el nombre de la promoción');
            $('#name').focus();
            return false;
        }
        
        if (isCoupon && !code) {
            e.preventDefault();
            alert('Por favor ingresa el código del cupón');
            $('#coupon_code').focus();
            return false;
        }
        
        if (isNaN(discount) || discount <= 0) {
            e.preventDefault();
            alert('Por favor ingresa un descuento válido');
            $('#discount').focus();
            return false;
        }
        
        return true;
    });
});
</script>

@endsection
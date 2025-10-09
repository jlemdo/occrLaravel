@extends('layouts.app')
@section('section')

<!-- Estilos personalizados coherentes con el patrón establecido -->
<style>
    .form-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items-center;
        gap: 0.5rem;
    }

    .form-floating {
        margin-bottom: 1rem;
    }

    .form-floating>label {
        font-weight: 500;
        color: #6c757d;
    }

    .btn-save {
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

    .btn-save:hover {
        background: #218838;
        border-color: #1e7e34;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        color: white;
    }

    .btn-cancel {
        background: #6c757d;
        border: 1px solid #6c757d;
        color: white;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        border-color: #545b62;
        transform: translateY(-1px);
        color: white;
    }

    .preview-info {
        background: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .stock-preview {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .stock-calculator {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .stock-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .stock-total {
        font-weight: 700;
        font-size: 1.2rem;
        color: #28a745;
        border-top: 2px solid #28a745;
        padding-top: 0.5rem;
    }

    .changes-indicator {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: none;
    }

    .changes-indicator.show {
        display: block;
    }
</style>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-9">
                <div class="card shadow-sm border-0 my-4">
                    <div class="card-header p-4 border-bottom"
                        style="background: white; border: 1px solid #dee2e6; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-dark mb-0">
                                    <i class="fas fa-edit me-2"></i>Editar Stock
                                </h4>
                                <p class="text-muted mb-0 small">Modifica el inventario del producto: {{ $proposals->product }}</p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{ URL::to('stock') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Volver al Inventario
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4">
                            <!-- Indicador de cambios -->
                            <div class="changes-indicator" id="changesIndicator">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Cambios Detectados</strong>
                                </div>
                                <small class="text-muted">
                                    Has realizado cambios en el stock. No olvides guardar antes de salir.
                                </small>
                            </div>

                            <!-- Información de ayuda -->
                            <div class="preview-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Editando Stock: {{ $proposals->product }}</strong>
                                </div>
                                <small class="text-muted">
                                    • Modifica la cantidad actual en inventario<br>
                                    • El cambio se reflejará inmediatamente en el sistema<br>
                                    • Utiliza la vista previa para verificar los cambios<br>
                                    • Puedes cambiar el producto asignado si es necesario
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <form action="{{ URL::to('updatestock') }}" method="POST" enctype="multipart/form-data" id="editStockForm">
                                        @csrf
                                        <input type="hidden" value="{{ $proposals->id }}" name="id">

                                        <!-- Sección: Información del Stock -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-cube text-primary"></i>Información del Stock
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-control" name="product" id="product" required>
                                                            <option value="">Seleccionar producto</option>
                                                            @foreach ($mods as $mod)
                                                                <option value="{{ $mod->name }}" @if ($proposals->product == $mod->name) selected @endif>
                                                                    {{ $mod->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label for="product">Producto *</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" step="1" class="form-control" id="qty" name="qty"
                                                            value="{{ old('qty', $proposals->qty) }}" required min="0" placeholder="Cantidad">
                                                        <label for="qty">Cantidad en Stock *</label>
                                                    </div>
                                                    <small class="text-muted">Cantidad actual disponible en inventario</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección: Historial y Notas -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-clipboard-list text-info"></i>Detalles del Ajuste
                                            </h5>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="notes" name="notes" placeholder="Observaciones"
                                                            style="height: 80px">{{ old('notes', $proposals->notes ?? '') }}</textarea>
                                                        <label for="notes">Razón del Ajuste (Opcional)</label>
                                                    </div>
                                                    <small class="text-muted">Especifica el motivo de la modificación del stock</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Información del Registro -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-history text-secondary"></i>Información del Registro
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <small class="text-muted d-block mb-1">ID del Registro:</small>
                                                    <strong class="text-primary">#{{ $proposals->id }}</strong>
                                                </div>
                                                <div class="col-md-4">
                                                    <small class="text-muted d-block mb-1">Creado:</small>
                                                    <strong>{{ $proposals->created_at ? $proposals->created_at->format('d/m/Y H:i') : 'N/A' }}</strong>
                                                </div>
                                                <div class="col-md-4">
                                                    <small class="text-muted d-block mb-1">Última Modificación:</small>
                                                    <strong>{{ $proposals->updated_at ? $proposals->updated_at->format('d/m/Y H:i') : 'N/A' }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botones de Acción -->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-save text-white btn-lg">
                                                <i class="fas fa-save me-2"></i>Actualizar Stock
                                            </button>
                                            <a href="{{ URL::to('stock') }}" class="btn btn-cancel btn-lg ms-3">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <!-- Panel de Vista Previa en Vivo -->
                                <div class="col-lg-4">
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-eye text-success"></i>Vista Previa del Stock
                                        </h5>
                                        <div class="stock-preview">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-center"
                                                     style="height: 100px; background: #f8f9fa; border-radius: 8px;">
                                                    <i class="fas fa-cube fa-3x text-success" id="previewIcon"></i>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <span class="badge bg-warning" id="livePreviewType">AJUSTE DE STOCK</span>
                                            </div>
                                            <h6 id="livePreviewProduct" class="mb-2">{{ $proposals->product }}</h6>
                                            <p id="livePreviewQty" class="text-muted small mb-3">Stock: {{ $proposals->qty }} unidades</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>Estado:</strong>
                                                <span class="fw-bold" id="livePreviewStatus">
                                                    @if($proposals->qty > 10)
                                                        <span class="text-success">DISPONIBLE</span>
                                                    @elseif($proposals->qty > 0)
                                                        <span class="text-warning">STOCK BAJO</span>
                                                    @else
                                                        <span class="text-danger">SIN STOCK</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="text-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Vista previa del stock actualizado
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Calculadora de Cambios -->
                                    <div class="stock-calculator">
                                        <h6 class="text-warning mb-3">
                                            <i class="fas fa-calculator me-1"></i>Resumen de Cambios
                                        </h6>
                                        <div class="stock-item">
                                            <span>Producto:</span>
                                            <span id="calcProduct">{{ $proposals->product }}</span>
                                        </div>
                                        <div class="stock-item">
                                            <span>Stock Original:</span>
                                            <span id="calcOriginalStock">{{ $proposals->qty }} unidades</span>
                                        </div>
                                        <div class="stock-item">
                                            <span>Nuevo Stock:</span>
                                            <span id="calcNewStock">{{ $proposals->qty }} unidades</span>
                                        </div>
                                        <hr>
                                        <div class="stock-item stock-total">
                                            <span>Diferencia:</span>
                                            <span id="calcDifference">0 unidades</span>
                                        </div>
                                        <div class="stock-item">
                                            <span>Tipo de Movimiento:</span>
                                            <span id="calcMovementType" class="fw-bold text-info">SIN CAMBIOS</span>
                                        </div>
                                    </div>

                                    <!-- Alertas de Stock -->
                                    <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 8px;" id="stockAlerts">
                                        <h6 class="text-muted mb-2">
                                            <i class="fas fa-bell me-1"></i>Alertas de Stock
                                        </h6>
                                        <div id="alertContainer">
                                            <!-- Las alertas se generarán dinámicamente -->
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables para controlar cambios
    let hasChanges = false;
    const originalValues = {
        product: '{{ $proposals->product }}',
        qty: {{ $proposals->qty }}
    };

    // Función para detectar cambios
    function detectChanges() {
        const currentProduct = document.getElementById('product').value;
        const currentQty = parseInt(document.getElementById('qty').value) || 0;
        
        hasChanges = (currentProduct !== originalValues.product) || (currentQty !== originalValues.qty);
        
        const indicator = document.getElementById('changesIndicator');
        if (hasChanges) {
            indicator.classList.add('show');
        } else {
            indicator.classList.remove('show');
        }
    }

    // Función para actualizar vista previa en tiempo real
    function updateLivePreview() {
        const productSelect = document.getElementById('product');
        const qtyInput = document.getElementById('qty');
        
        const productName = productSelect.options[productSelect.selectedIndex].text || 'Producto no seleccionado';
        const qty = parseInt(qtyInput.value) || 0;
        const originalQty = originalValues.qty;
        const difference = qty - originalQty;

        // Actualizar vista previa
        document.getElementById('livePreviewProduct').textContent = productName;
        document.getElementById('livePreviewQty').textContent = `Stock: ${qty} unidades`;
        
        // Actualizar estado del stock
        const statusElement = document.getElementById('livePreviewStatus');
        if (qty > 10) {
            statusElement.innerHTML = '<span class="text-success">DISPONIBLE</span>';
        } else if (qty > 0) {
            statusElement.innerHTML = '<span class="text-warning">STOCK BAJO</span>';
        } else {
            statusElement.innerHTML = '<span class="text-danger">SIN STOCK</span>';
        }
        
        // Actualizar calculadora
        document.getElementById('calcProduct').textContent = productName;
        document.getElementById('calcNewStock').textContent = `${qty} unidades`;
        document.getElementById('calcDifference').textContent = `${difference >= 0 ? '+' : ''}${difference} unidades`;
        
        // Actualizar tipo de movimiento
        const movementTypeElement = document.getElementById('calcMovementType');
        const differenceElement = document.getElementById('calcDifference');
        
        if (difference > 0) {
            movementTypeElement.textContent = 'INCREMENTO';
            movementTypeElement.className = 'fw-bold text-success';
            differenceElement.className = 'text-success fw-bold';
        } else if (difference < 0) {
            movementTypeElement.textContent = 'REDUCCIÓN';
            movementTypeElement.className = 'fw-bold text-danger';
            differenceElement.className = 'text-danger fw-bold';
        } else {
            movementTypeElement.textContent = 'SIN CAMBIOS';
            movementTypeElement.className = 'fw-bold text-info';
            differenceElement.className = 'text-info fw-bold';
        }
        
        // Generar alertas de stock
        generateStockAlerts(qty, difference);
    }

    // Función para generar alertas de stock
    function generateStockAlerts(qty, difference) {
        const alertContainer = document.getElementById('alertContainer');
        let alerts = [];
        
        if (qty === 0) {
            alerts.push('<div class="alert alert-danger alert-sm mb-2 py-1"><i class="fas fa-exclamation-triangle me-1"></i> Producto sin stock disponible</div>');
        } else if (qty <= 5) {
            alerts.push('<div class="alert alert-warning alert-sm mb-2 py-1"><i class="fas fa-exclamation-circle me-1"></i> Stock críticamente bajo</div>');
        } else if (qty <= 10) {
            alerts.push('<div class="alert alert-info alert-sm mb-2 py-1"><i class="fas fa-info-circle me-1"></i> Considerar reabastecimiento</div>');
        }
        
        if (difference > 50) {
            alerts.push('<div class="alert alert-primary alert-sm mb-2 py-1"><i class="fas fa-arrow-up me-1"></i> Incremento significativo de stock</div>');
        }
        
        if (alerts.length === 0) {
            alerts.push('<small class="text-muted"><i class="fas fa-check-circle me-1"></i> Sin alertas de stock</small>');
        }
        
        alertContainer.innerHTML = alerts.join('');
    }

    // Event listeners
    document.getElementById('product').addEventListener('change', function() {
        detectChanges();
        updateLivePreview();
    });
    
    document.getElementById('qty').addEventListener('input', function() {
        detectChanges();
        updateLivePreview();
    });

    // Validación del formulario
    document.getElementById('editStockForm').addEventListener('submit', function(e) {
        const product = document.getElementById('product').value;
        const qty = parseInt(document.getElementById('qty').value);

        if (!product) {
            e.preventDefault();
            alert('Debes seleccionar un producto');
            document.getElementById('product').focus();
            return;
        }

        if (isNaN(qty) || qty < 0) {
            e.preventDefault();
            alert('La cantidad debe ser un número mayor o igual a 0');
            document.getElementById('qty').focus();
            return;
        }

        if (hasChanges) {
            const difference = qty - originalValues.qty;
            let confirmMessage = `¿Confirmas actualizar el stock?\n\n`;
            confirmMessage += `Producto: ${document.getElementById('product').options[document.getElementById('product').selectedIndex].text}\n`;
            confirmMessage += `Stock actual: ${originalValues.qty} unidades\n`;
            confirmMessage += `Nuevo stock: ${qty} unidades\n`;
            confirmMessage += `Cambio: ${difference >= 0 ? '+' : ''}${difference} unidades`;
            
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                return;
            }
        }
    });

    // Advertencia al salir sin guardar
    window.addEventListener('beforeunload', function(e) {
        if (hasChanges) {
            e.preventDefault();
            e.returnValue = '¿Estás seguro de que deseas salir sin guardar los cambios en el stock?';
            return e.returnValue;
        }
    });

    // Actualizar preview inicial
    updateLivePreview();
});
</script>

@endsection
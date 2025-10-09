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
        align-items: center;
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
                                    <i class="fas fa-boxes me-2"></i>Agregar Nuevo Stock
                                </h4>
                                <p class="text-muted mb-0 small">Registra nuevo inventario de productos</p>
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
                            <!-- Información de ayuda -->
                            <div class="preview-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Registro de Inventario</strong>
                                </div>
                                <small class="text-muted">
                                    • Selecciona el producto del cual deseas agregar stock<br>
                                    • Ingresa la cantidad exacta que estás añadiendo al inventario<br>
                                    • El sistema actualizará automáticamente el stock disponible<br>
                                    • Utiliza la vista previa para verificar la información
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <form method="post" action="{{ route('addstock') }}" enctype="multipart/form-data" id="stockForm">
                                        @csrf

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
                                                                <option value="{{ $mod->name }}" data-id="{{ $mod->id }}">
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
                                                            value="{{ old('qty') }}" required min="1" placeholder="Cantidad">
                                                        <label for="qty">Cantidad a Agregar *</label>
                                                    </div>
                                                    <small class="text-muted">Cantidad de unidades que se añadirán al inventario</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección: Detalles Adicionales -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-clipboard-list text-info"></i>Detalles del Movimiento
                                            </h5>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="notes" name="notes" placeholder="Observaciones"
                                                            style="height: 80px">{{ old('notes') }}</textarea>
                                                        <label for="notes">Observaciones (Opcional)</label>
                                                    </div>
                                                    <small class="text-muted">Información adicional sobre este movimiento de stock</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botones de Acción -->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-save text-white btn-lg">
                                                <i class="fas fa-plus me-2"></i>Agregar Stock
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
                                            <i class="fas fa-eye text-success"></i>Vista Previa del Movimiento
                                        </h5>
                                        <div class="stock-preview">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-center"
                                                     style="height: 100px; background: #f8f9fa; border-radius: 8px;">
                                                    <i class="fas fa-cube fa-3x text-muted" id="previewIcon"></i>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <span class="badge bg-success" id="livePreviewType">INGRESO DE STOCK</span>
                                            </div>
                                            <h6 id="livePreviewProduct" class="mb-2">Selecciona un producto</h6>
                                            <p id="livePreviewQty" class="text-muted small mb-3">Cantidad: 0 unidades</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>Fecha:</strong>
                                                <span class="text-info fw-bold" id="livePreviewDate"></span>
                                            </div>
                                            <div class="text-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Vista previa del movimiento de stock
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Calculadora de Stock -->
                                    <div class="stock-calculator">
                                        <h6 class="text-success mb-3">
                                            <i class="fas fa-calculator me-1"></i>Resumen del Movimiento
                                        </h6>
                                        <div class="stock-item">
                                            <span>Producto:</span>
                                            <span id="calcProduct">No seleccionado</span>
                                        </div>
                                        <div class="stock-item">
                                            <span>Stock Actual:</span>
                                            <span id="calcCurrentStock">0 unidades</span>
                                        </div>
                                        <div class="stock-item">
                                            <span>Cantidad a Agregar:</span>
                                            <span id="calcAddQty">0 unidades</span>
                                        </div>
                                        <hr>
                                        <div class="stock-item stock-total">
                                            <span>Nuevo Stock Total:</span>
                                            <span id="calcNewTotal">0 unidades</span>
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
    // Establecer fecha actual en la vista previa
    const today = new Date().toLocaleDateString('es-ES');
    document.getElementById('livePreviewDate').textContent = today;

    // Función para actualizar vista previa en tiempo real
    function updateLivePreview() {
        const productSelect = document.getElementById('product');
        const qtyInput = document.getElementById('qty');
        
        const productName = productSelect.options[productSelect.selectedIndex].text || 'Selecciona un producto';
        const qty = parseInt(qtyInput.value) || 0;

        // Actualizar vista previa
        document.getElementById('livePreviewProduct').textContent = productName;
        document.getElementById('livePreviewQty').textContent = `Cantidad: ${qty} unidades`;
        
        // Actualizar calculadora
        document.getElementById('calcProduct').textContent = productName;
        document.getElementById('calcAddQty').textContent = `${qty} unidades`;
        
        // Simular stock actual (en una implementación real esto vendría de la base de datos)
        const currentStock = Math.floor(Math.random() * 100); // Placeholder
        const newTotal = currentStock + qty;
        
        document.getElementById('calcCurrentStock').textContent = `${currentStock} unidades`;
        document.getElementById('calcNewTotal').textContent = `${newTotal} unidades`;
        
        // Cambiar icono según si hay producto seleccionado
        const previewIcon = document.getElementById('previewIcon');
        if (productSelect.value) {
            previewIcon.className = 'fas fa-cube fa-3x text-success';
        } else {
            previewIcon.className = 'fas fa-cube fa-3x text-muted';
        }
    }

    // Event listeners
    document.getElementById('product').addEventListener('change', updateLivePreview);
    document.getElementById('qty').addEventListener('input', updateLivePreview);

    // Validación del formulario
    document.getElementById('stockForm').addEventListener('submit', function(e) {
        const product = document.getElementById('product').value;
        const qty = parseInt(document.getElementById('qty').value);

        if (!product) {
            e.preventDefault();
            alert('Debes seleccionar un producto');
            document.getElementById('product').focus();
            return;
        }

        if (!qty || qty <= 0) {
            e.preventDefault();
            alert('La cantidad debe ser mayor a 0');
            document.getElementById('qty').focus();
            return;
        }

        if (!confirm(`¿Confirmas agregar ${qty} unidades del producto "${document.getElementById('product').options[document.getElementById('product').selectedIndex].text}" al inventario?`)) {
            e.preventDefault();
            return;
        }
    });

    // Actualizar preview inicial
    updateLivePreview();
});
</script>

@endsection
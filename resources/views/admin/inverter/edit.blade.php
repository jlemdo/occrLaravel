@extends('layouts.app')
@section('section')

<!-- Estilos personalizados coherentes con addnew -->
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

    .current-image-section {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        background: #f8f9fa;
        margin-bottom: 1rem;
    }

    .current-image-section img {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .current-image-section img:hover {
        transform: scale(1.05);
    }

    .upload-area {
        border: 2px dashed #ced4da;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #0d6efd;
        background: rgba(13, 110, 253, 0.05);
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

    .preview-container {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .preview-info {
        background: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .product-preview {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .product-preview img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .price-calculator {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .price-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .price-final {
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
                                    <i class="fas fa-edit me-2"></i>Editar Producto
                                </h4>
                                <p class="text-muted mb-0 small">Modifica la información del producto: {{ $proposals->name }}</p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{ URL::to('product') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Volver al Listado
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
                                    Has realizado cambios en el producto. No olvides guardar antes de salir.
                                </small>
                            </div>

                            <!-- Información de ayuda -->
                            <div class="preview-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Editando: {{ $proposals->name }}</strong>
                                </div>
                                <small class="text-muted">
                                    • Modifica solo los campos que necesites cambiar<br>
                                    • La imagen actual se mantendrá si no subes una nueva<br>
                                    • Los cambios de precio se reflejarán inmediatamente en la vista previa<br>
                                    • Usa la calculadora para verificar márgenes de ganancia
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <form method="post" action="{{ URL::to('updateinverter') }}" enctype="multipart/form-data" id="editForm">
                                        @csrf
                                        <input type="hidden" value="{{ $proposals->id }}" name="id">

                                        <!-- Sección: Información Básica -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-box-open text-primary"></i>Información del Producto
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="title" name="title"
                                                            value="{{ old('title', $proposals->name) }}" required
                                                            placeholder="Nombre del producto">
                                                        <label for="title">Nombre del Producto *</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-control" name="product_cat" id="product_cat" required>
                                                            <option value="">Seleccionar categoría</option>
                                                            @foreach ($mods as $mod)
                                                                <option value="{{ $mod->name }}" @if ($proposals->product_cat == $mod->name) selected @endif>
                                                                    {{ $mod->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label for="product_cat">Categoría *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="description" name="description" placeholder="Descripción del producto"
                                                            style="height: 100px">{{ old('description', $proposals->description) }}</textarea>
                                                        <label for="description">Descripción del Producto</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección: Cantidad y Unidades -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-weight text-success"></i>Cantidad y Medidas
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="quantity" name="quantity"
                                                            value="{{ old('quantity', $proposals->quantity ?? '') }}" required min="0"
                                                            placeholder="Cantidad">
                                                        <label for="quantity">Cantidad *</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <select class="form-control" name="unit" id="unit" required>
                                                            <option value="">Seleccionar unidad</option>
                                                            <option value="Gr" @if ($proposals->unit == 'Gr') selected @endif>Gramos (gr)</option>
                                                            <option value="Kg" @if ($proposals->unit == 'Kg') selected @endif>Kilogramos (kg)</option>
                                                            <option value="ml" @if ($proposals->unit == 'ml') selected @endif>Mililitros (ml)</option>
                                                            <option value="L" @if ($proposals->unit == 'L') selected @endif>Litros (L)</option>
                                                            <option value="Pieces" @if ($proposals->unit == 'Pieces') selected @endif>Piezas</option>
                                                        </select>
                                                        <label for="unit">Unidad de Medida *</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección: Precios -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-dollar-sign text-warning"></i>Configuración de Precios
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="cost" name="cost"
                                                            value="{{ old('cost', $proposals->cost) }}" min="0" placeholder="Costo">
                                                        <label for="cost">Costo Interno ($)</label>
                                                    </div>
                                                    <small class="text-muted">Precio de adquisición o producción</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                                                            value="{{ old('price', $proposals->price) }}" required min="0" placeholder="Precio público">
                                                        <label for="price">Precio Público ($) *</label>
                                                    </div>
                                                    <small class="text-muted">Precio de venta al cliente</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="discount" name="discount"
                                                            value="{{ old('discount', $proposals->discount) }}" min="0" placeholder="Descuento">
                                                        <label for="discount">Descuento ($)</label>
                                                    </div>
                                                    <small class="text-muted">Descuento aplicable (opcional)</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección: Imagen del Producto -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-image text-secondary"></i>Imagen del Producto
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="upload-area">
                                                        <input type="file" class="form-control" id="photo" name="photo"
                                                            accept="image/*" style="opacity: 0; position: absolute; z-index: -1;">
                                                        <label for="photo" style="cursor: pointer; width: 100%;">
                                                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                                            <p class="mb-0"><strong>Cambiar imagen del producto</strong></p>
                                                            <p class="text-muted small mb-0">JPG, PNG, GIF (máx. 5MB) - Opcional</p>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="current-image-section">
                                                        <h6 class="text-muted mb-3">Imagen Actual</h6>
                                                        <img src="{{ asset('mydoc/' . $proposals->photo) }}" alt="{{ $proposals->name }}"
                                                            style="max-width: 200px; max-height: 150px;" class="img-thumbnail" id="currentImage">
                                                        <br><small class="text-muted mt-2 d-block">{{ $proposals->photo }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Preview de nueva imagen -->
                                            <div class="row mt-3" id="newImagePreview" style="display: none;">
                                                <div class="col-md-6 offset-md-6">
                                                    <div class="preview-container">
                                                        <img id="imagePreview" src="" alt="Vista previa nueva imagen" 
                                                            style="max-width: 200px; max-height: 150px; display: none;" class="img-thumbnail">
                                                        <p id="previewText" class="text-muted small mt-2 mb-0">Vista previa de la nueva imagen</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botones de Acción -->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-save text-white btn-lg">
                                                <i class="fas fa-save me-2"></i>Actualizar Producto
                                            </button>
                                            <a href="{{ URL::to('product') }}" class="btn btn-cancel btn-lg ms-3">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <!-- Panel de Vista Previa en Vivo -->
                                <div class="col-lg-4">
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-eye text-info"></i>Vista Previa del Producto
                                        </h5>
                                        <div class="product-preview">
                                            <div class="text-center mb-3">
                                                <div id="livePreviewImage" class="d-flex align-items-center justify-content-center"
                                                     style="height: 150px; background: #f8f9fa; border-radius: 8px;">
                                                    <img src="{{ asset('mydoc/' . $proposals->photo) }}" alt="{{ $proposals->name }}"
                                                         style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <span class="badge bg-primary" id="livePreviewCategory">{{ $proposals->product_cat }}</span>
                                            </div>
                                            <h6 id="livePreviewTitle" class="mb-2">{{ $proposals->name }}</h6>
                                            <p id="livePreviewDescription" class="text-muted small mb-3">{{ $proposals->description ?: 'Descripción del producto' }}</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong id="livePreviewQuantity">{{ $proposals->quantity }} {{ strtolower($proposals->unit) }}</strong>
                                                <span class="text-success fw-bold" id="livePreviewPrice">${{ number_format(max(0, $proposals->price - ($proposals->discount ?? 0)), 0) }}</span>
                                            </div>
                                            <div class="text-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Así se verá tu producto actualizado
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Calculadora de Precios -->
                                    <div class="price-calculator">
                                        <h6 class="text-success mb-3">
                                            <i class="fas fa-calculator me-1"></i>Calculadora de Precios
                                        </h6>
                                        <div class="price-item">
                                            <span>Costo:</span>
                                            <span id="calcCost">${{ number_format($proposals->cost ?? 0, 2) }}</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Precio Público:</span>
                                            <span id="calcPrice">${{ number_format($proposals->price, 2) }}</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Descuento:</span>
                                            <span id="calcDiscount">${{ number_format($proposals->discount ?? 0, 2) }}</span>
                                        </div>
                                        <hr>
                                        <div class="price-item price-final">
                                            <span>Precio Final:</span>
                                            <span id="calcFinal">${{ number_format(max(0, $proposals->price - ($proposals->discount ?? 0)), 2) }}</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Margen de Ganancia:</span>
                                            <span id="calcMargin" class="text-info fw-bold">
                                                @if($proposals->cost && $proposals->cost > 0)
                                                    {{ number_format((((max(0, $proposals->price - ($proposals->discount ?? 0))) - $proposals->cost) / $proposals->cost * 100), 1) }}%
                                                @else
                                                    0%
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Información del producto -->
                                    <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 8px;">
                                        <h6 class="text-muted mb-2">
                                            <i class="fas fa-info me-1"></i>Información del Producto
                                        </h6>
                                        <ul class="list-unstyled mb-0 small text-muted">
                                            <li class="mb-1">• <strong>ID:</strong> {{ $proposals->id }}</li>
                                            <li class="mb-1">• <strong>Creado:</strong> {{ $proposals->created_at ? $proposals->created_at->format('d/m/Y') : 'N/A' }}</li>
                                            <li class="mb-0">• <strong>Modificado:</strong> {{ $proposals->updated_at ? $proposals->updated_at->format('d/m/Y H:i') : 'N/A' }}</li>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables para controlar cambios
    let hasChanges = false;
    const originalValues = {};
    
    // Obtener valores originales del formulario
    const formInputs = document.querySelectorAll('#editForm input, #editForm select, #editForm textarea');
    formInputs.forEach(input => {
        if (input.type !== 'file' && input.name !== '_token') {
            originalValues[input.name] = input.value;
        }
    });

    // Función para detectar cambios
    function detectChanges() {
        let changesDetected = false;
        formInputs.forEach(input => {
            if (input.type !== 'file' && input.name !== '_token' && input.name !== 'id') {
                if (input.value !== originalValues[input.name]) {
                    changesDetected = true;
                }
            }
        });
        
        // Verificar si se seleccionó un archivo nuevo
        const photoInput = document.getElementById('photo');
        if (photoInput && photoInput.files.length > 0) {
            changesDetected = true;
        }
        
        hasChanges = changesDetected;
        
        // Mostrar/ocultar indicador de cambios
        const indicator = document.getElementById('changesIndicator');
        if (hasChanges) {
            indicator.classList.add('show');
        } else {
            indicator.classList.remove('show');
        }
    }

    // Función para actualizar vista previa en tiempo real
    function updateLivePreview() {
        const title = document.getElementById('title').value || 'Nombre del producto';
        const category = document.getElementById('product_cat').value || 'Sin categoría';
        const description = document.getElementById('description').value || 'Descripción del producto';
        const quantity = document.getElementById('quantity').value || '0';
        const unit = document.getElementById('unit').value || 'unidad';
        const price = parseFloat(document.getElementById('price').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const finalPrice = Math.max(0, price - discount);

        // Actualizar vista previa
        document.getElementById('livePreviewTitle').textContent = title;
        document.getElementById('livePreviewCategory').textContent = category;
        document.getElementById('livePreviewDescription').textContent = description;
        document.getElementById('livePreviewQuantity').textContent = `${quantity} ${unit.toLowerCase()}`;
        document.getElementById('livePreviewPrice').textContent = `$${finalPrice.toLocaleString()}`;
    }

    // Función para actualizar calculadora de precios
    function updatePriceCalculator() {
        const cost = parseFloat(document.getElementById('cost').value) || 0;
        const price = parseFloat(document.getElementById('price').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const finalPrice = Math.max(0, price - discount);
        
        // Calcular margen de ganancia
        let margin = 0;
        if (cost > 0 && finalPrice > cost) {
            margin = ((finalPrice - cost) / cost) * 100;
        }

        // Actualizar calculadora
        document.getElementById('calcCost').textContent = `$${cost.toFixed(2)}`;
        document.getElementById('calcPrice').textContent = `$${price.toFixed(2)}`;
        document.getElementById('calcDiscount').textContent = `$${discount.toFixed(2)}`;
        document.getElementById('calcFinal').textContent = `$${finalPrice.toFixed(2)}`;
        document.getElementById('calcMargin').textContent = `${margin.toFixed(1)}%`;
        
        // Cambiar color del margen según rentabilidad
        const marginElement = document.getElementById('calcMargin');
        if (margin < 10) {
            marginElement.className = 'text-danger fw-bold';
        } else if (margin < 30) {
            marginElement.className = 'text-warning fw-bold';
        } else {
            marginElement.className = 'text-success fw-bold';
        }
    }

    // Event listeners para todos los campos del formulario
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            detectChanges();
            updateLivePreview();
            updatePriceCalculator();
        });
        
        input.addEventListener('change', function() {
            detectChanges();
            updateLivePreview();
            updatePriceCalculator();
        });
    });

    // Manejo de la imagen
    const photoInput = document.getElementById('photo');
    const imagePreview = document.getElementById('imagePreview');
    const newImagePreview = document.getElementById('newImagePreview');
    const livePreviewImage = document.querySelector('#livePreviewImage img');

    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                newImagePreview.style.display = 'block';
                livePreviewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            newImagePreview.style.display = 'none';
            // Restaurar imagen original
            livePreviewImage.src = "{{ asset('mydoc/' . $proposals->photo) }}";
        }
        detectChanges();
    });

    // Validación del formulario
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const category = document.getElementById('product_cat').value;
        const price = parseFloat(document.getElementById('price').value);

        if (!title) {
            e.preventDefault();
            alert('El nombre del producto es obligatorio');
            document.getElementById('title').focus();
            return;
        }

        if (!category) {
            e.preventDefault();
            alert('Debes seleccionar una categoría');
            document.getElementById('product_cat').focus();
            return;
        }

        if (isNaN(price) || price <= 0) {
            e.preventDefault();
            alert('El precio debe ser un número mayor a 0');
            document.getElementById('price').focus();
            return;
        }

        // Confirmación si hay cambios significativos
        if (hasChanges) {
            if (!confirm('¿Estás seguro de que deseas guardar los cambios realizados?')) {
                e.preventDefault();
                return;
            }
        }
    });

    // Advertencia al salir sin guardar
    window.addEventListener('beforeunload', function(e) {
        if (hasChanges) {
            e.preventDefault();
            e.returnValue = '¿Estás seguro de que deseas salir sin guardar los cambios?';
            return e.returnValue;
        }
    });

    // Actualizar preview inicial
    updateLivePreview();
    updatePriceCalculator();
});
</script>

@endsection
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
            background: #fff3cd;
            border: 1px solid #ffeaa7;
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

        .input-group-text {
            background: #f8f9fa;
            border-color: #e9ecef;
            color: #6c757d;
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
                                        <i class="fas fa-plus-circle me-2"></i>Crear Nuevo Producto
                                    </h4>
                                    <p class="text-muted mb-0 small">Complete la información para agregar un nuevo producto
                                        al catálogo</p>
                                </div>
                                <div class="col col-md-auto">
                                    <a href="{{ URL::to('product') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left me-1"></i>Volver
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-4">
                                <!-- Información de ayuda -->
                                <div class="preview-info">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-lightbulb me-2"></i>
                                        <strong>Guía para crear un producto efectivo</strong>
                                    </div>
                                    <small class="text-muted">
                                        • Use nombres descriptivos y claros para los productos<br>
                                        • Seleccione la categoría correcta para facilitar la búsqueda<br>
                                        • Configure precios competitivos y calcule márgenes de ganancia<br>
                                        • Suba imágenes de alta calidad que muestren el producto claramente
                                    </small>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <form method="post" action="{{ route('addinverter') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Sección: Información Básica -->
                                            <div class="form-section">
                                                <h5 class="section-title">
                                                    <i class="fas fa-box-open text-primary"></i>Información del Producto
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ old('title') }}" required
                                                                placeholder="Nombre del producto">
                                                            <label for="title">Nombre del Producto *</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-control" name="product_cat" id="product_cat"
                                                                required>
                                                                <option value="">Seleccionar categoría</option>
                                                                @foreach ($mods as $mod)
                                                                    <option value="{{ $mod->name }}">{{ $mod->name }}
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
                                                                style="height: 100px">{{ old('description') }}</textarea>
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
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="quantity" name="quantity" value="{{ old('quantity') }}"
                                                                required min="0" placeholder="Cantidad">
                                                            <label for="quantity">Cantidad *</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <select class="form-control" name="unit" id="unit"
                                                                required>
                                                                <option value="">Seleccionar unidad</option>
                                                                <option value="Gr">Gramos (gr)</option>
                                                                <option value="Kg">Kilogramos (kg)</option>
                                                                <option value="ml">Mililitros (ml)</option>
                                                                <option value="L">Litros (L)</option>
                                                                <option value="Pieces">Piezas</option>
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
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="cost" name="cost" value="{{ old('cost') }}"
                                                                min="0" placeholder="Costo">
                                                            <label for="cost">Costo Interno ($)</label>
                                                        </div>
                                                        <small class="text-muted">Precio de adquisición o producción</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="price" name="price" value="{{ old('price') }}"
                                                                required min="0" placeholder="Precio público">
                                                            <label for="price">Precio Público ($) *</label>
                                                        </div>
                                                        <small class="text-muted">Precio de venta al cliente</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="discount" name="discount"
                                                                value="{{ old('discount', 0) }}" min="0"
                                                                placeholder="Descuento">
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
                                                    <div class="col-md-8">
                                                        <div class="upload-area">
                                                            <input type="file" class="form-control" id="photo"
                                                                name="photo" accept="image/*" required
                                                                style="opacity: 0; position: absolute; z-index: -1;">
                                                            <label for="photo" style="cursor: pointer; width: 100%;">
                                                                <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                                                <p class="mb-0"><strong>Hacer clic para subir imagen</strong></p>
                                                                <p class="text-muted small mb-0">Formatos: JPG, PNG, GIF (máx. 5MB) *</p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="text-center">
                                                            <h6 class="text-muted mb-3">Vista Previa</h6>
                                                            <div class="preview-container">
                                                                <img id="imagePreview" src="" alt="Vista previa"
                                                                    style="max-width: 150px; max-height: 150px; display: none;" class="img-thumbnail">
                                                                <p id="previewText" class="text-muted small mt-2 mb-0">Selecciona una imagen para ver la vista previa</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Botones de Acción -->
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-save text-white btn-lg">
                                                    <i class="fas fa-save me-2"></i>Crear Producto
                                                </button>
                                                <a href="{{ URL::to('product') }}" class="btn btn-outline-secondary btn-lg ms-3">
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
                                                    <i class="fas fa-box fa-2x text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <span class="badge bg-primary" id="livePreviewCategory">Categoría</span>
                                            </div>
                                            <h6 id="livePreviewTitle" class="mb-2">Nombre del producto</h6>
                                            <p id="livePreviewDescription" class="text-muted small mb-3">Descripción del producto</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong id="livePreviewQuantity">Cantidad</strong>
                                                <span class="text-success fw-bold" id="livePreviewPrice">$0</span>
                                            </div>
                                            <div class="text-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Así se verá tu producto
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
                                            <span id="calcCost">$0.00</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Precio Público:</span>
                                            <span id="calcPrice">$0.00</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Descuento:</span>
                                            <span id="calcDiscount">$0.00</span>
                                        </div>
                                        <hr>
                                        <div class="price-item price-final">
                                            <span>Precio Final:</span>
                                            <span id="calcFinal">$0.00</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Margen de Ganancia:</span>
                                            <span id="calcMargin" class="text-info fw-bold">0%</span>
                                        </div>
                                    </div>

                                    <!-- Tips adicionales -->
                                    <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 8px;">
                                        <h6 class="text-muted mb-2">
                                            <i class="fas fa-star me-1"></i>Recomendaciones
                                        </h6>
                                        <ul class="list-unstyled mb-0 small text-muted">
                                            <li class="mb-1">• <strong>Imágenes:</strong> 500x500px recomendado</li>
                                            <li class="mb-1">• <strong>Nombres:</strong> Máximo 50 caracteres</li>
                                            <li class="mb-1">• <strong>Descripción:</strong> 100-200 caracteres</li>
                                            <li class="mb-0">• <strong>Precios:</strong> Considera la competencia</li>
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

    <!-- JavaScript para funcionalidad mejorada -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const categorySelect = document.getElementById('product_cat');
            const descriptionInput = document.getElementById('description');
            const quantityInput = document.getElementById('quantity');
            const unitSelect = document.getElementById('unit');
            const costInput = document.getElementById('cost');
            const priceInput = document.getElementById('price');
            const discountInput = document.getElementById('discount');
            const photoInput = document.getElementById('photo');
            const imagePreview = document.getElementById('imagePreview');
            const previewText = document.getElementById('previewText');
            
            // Elementos de vista previa en vivo
            const livePreviewTitle = document.getElementById('livePreviewTitle');
            const livePreviewCategory = document.getElementById('livePreviewCategory');
            const livePreviewDescription = document.getElementById('livePreviewDescription');
            const livePreviewQuantity = document.getElementById('livePreviewQuantity');
            const livePreviewPrice = document.getElementById('livePreviewPrice');
            const livePreviewImage = document.getElementById('livePreviewImage');
            
            // Elementos de calculadora
            const calcCost = document.getElementById('calcCost');
            const calcPrice = document.getElementById('calcPrice');
            const calcDiscount = document.getElementById('calcDiscount');
            const calcFinal = document.getElementById('calcFinal');
            const calcMargin = document.getElementById('calcMargin');

            // Vista previa de imagen
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        previewText.textContent = 'Imagen seleccionada: ' + file.name;
                        
                        // Actualizar vista previa en vivo
                        livePreviewImage.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;" alt="Preview">`;
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                    previewText.textContent = 'Selecciona una imagen para ver la vista previa';
                    livePreviewImage.innerHTML = '<i class="fas fa-box fa-2x text-muted"></i>';
                }
            });

            // Función para actualizar calculadora de precios
            function updatePriceCalculator() {
                const cost = parseFloat(costInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                const discount = parseFloat(discountInput.value) || 0;
                const finalPrice = Math.max(0, price - discount);
                const margin = cost > 0 ? ((finalPrice - cost) / cost * 100).toFixed(1) : 0;
                
                calcCost.textContent = `$${cost.toFixed(2)}`;
                calcPrice.textContent = `$${price.toFixed(2)}`;
                calcDiscount.textContent = `$${discount.toFixed(2)}`;
                calcFinal.textContent = `$${finalPrice.toFixed(2)}`;
                calcMargin.textContent = `${margin}%`;
                
                // Actualizar vista previa
                livePreviewPrice.textContent = `$${finalPrice.toFixed(0)}`;
            }

            // Vista previa en vivo
            titleInput.addEventListener('input', function(e) {
                livePreviewTitle.textContent = e.target.value || 'Nombre del producto';
            });

            categorySelect.addEventListener('change', function(e) {
                livePreviewCategory.textContent = e.target.value || 'Categoría';
            });

            descriptionInput.addEventListener('input', function(e) {
                livePreviewDescription.textContent = e.target.value || 'Descripción del producto';
            });

            function updateQuantityPreview() {
                const quantity = quantityInput.value || '0';
                const unit = unitSelect.options[unitSelect.selectedIndex]?.text || 'unidad';
                livePreviewQuantity.textContent = `${quantity} ${unit.toLowerCase()}`;
            }

            quantityInput.addEventListener('input', updateQuantityPreview);
            unitSelect.addEventListener('change', updateQuantityPreview);

            // Event listeners para calculadora
            costInput.addEventListener('input', updatePriceCalculator);
            priceInput.addEventListener('input', updatePriceCalculator);
            discountInput.addEventListener('input', updatePriceCalculator);

            // Validación del formulario
            document.querySelector('form').addEventListener('submit', function(e) {
                const requiredFields = ['title', 'product_cat', 'quantity', 'unit', 'price', 'photo'];
                let isValid = true;
                let errorMessages = [];
                
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if ((field === 'photo' && !input.files[0]) || (field !== 'photo' && !input.value.trim())) {
                        input.classList.add('is-invalid');
                        isValid = false;
                        
                        switch(field) {
                            case 'title': errorMessages.push('• El nombre del producto es obligatorio'); break;
                            case 'product_cat': errorMessages.push('• La categoría es obligatoria'); break;
                            case 'quantity': errorMessages.push('• La cantidad es obligatoria'); break;
                            case 'unit': errorMessages.push('• La unidad de medida es obligatoria'); break;
                            case 'price': errorMessages.push('• El precio público es obligatorio'); break;
                            case 'photo': errorMessages.push('• La imagen del producto es obligatoria'); break;
                        }
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                // Validaciones adicionales
                if (priceInput.value && parseFloat(priceInput.value) <= 0) {
                    priceInput.classList.add('is-invalid');
                    errorMessages.push('• El precio debe ser mayor a 0');
                    isValid = false;
                }
                
                if (quantityInput.value && parseFloat(quantityInput.value) <= 0) {
                    quantityInput.classList.add('is-invalid');
                    errorMessages.push('• La cantidad debe ser mayor a 0');
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                    alert('⚠️ Por favor corrija los siguientes errores:\\n\\n' + errorMessages.join('\\n'));
                }
            });

            // Animación de entrada
            const sections = document.querySelectorAll('.form-section, .product-preview, .price-calculator');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    section.style.transition = 'all 0.3s ease';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });
    </script>
@endsection

@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.form-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #dee2e6;
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

.form-floating > label {
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

.category-preview {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.category-preview img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
}

.category-preview h6 {
    margin: 0.5rem 0;
    font-weight: 600;
}

.category-preview p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
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
                                    <i class="fas fa-plus-circle me-2"></i>Crear Nueva Categoría
                                </h4>
                                <p class="text-muted mb-0 small">Complete la información para crear una nueva categoría de productos</p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{URL::to('modules')}}" class="btn btn-secondary btn-sm">
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
                                    <strong>Consejos para crear una categoría efectiva</strong>
                                </div>
                                <small class="text-muted">
                                    • Use nombres claros y descriptivos para las categorías<br>
                                    • Agregue una descripción que ayude a los usuarios a entender el contenido<br>
                                    • Suba una imagen representativa de alta calidad
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <form method="post" action="{{route('addmodules')}}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- Sección: Información Básica -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-layer-group text-primary"></i>Información de Categoría
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="title" name="title" 
                                                               value="{{old('title')}}" required placeholder="Nombre de categoría">
                                                        <label for="title">Nombre de Categoría *</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="description" name="description" 
                                                               value="{{old('description')}}" placeholder="Descripción">
                                                        <label for="description">Descripción</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección: Imagen de Categoría -->
                                        <div class="form-section">
                                            <h5 class="section-title">
                                                <i class="fas fa-image text-secondary"></i>Imagen de Categoría
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="upload-area">
                                                        <input type="file" class="form-control" id="photo" name="photo" 
                                                               accept="image/*" required style="opacity: 0; position: absolute; z-index: -1;">
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
                                                <i class="fas fa-save me-2"></i>Crear Categoría
                                            </button>
                                            <a href="{{URL::to('modules')}}" class="btn btn-outline-secondary btn-lg ms-3">
                                                <i class="fas fa-times me-2"></i>Cancelar
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <!-- Panel de Vista Previa en Vivo -->
                                <div class="col-lg-4">
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-eye text-info"></i>Vista Previa en Vivo
                                        </h5>
                                        <div class="category-preview">
                                            <div class="text-center mb-3">
                                                <div id="livePreviewImage" class="d-flex align-items-center justify-content-center" 
                                                     style="height: 120px; background: #f8f9fa; border-radius: 8px;">
                                                    <i class="fas fa-image fa-2x text-muted"></i>
                                                </div>
                                            </div>
                                            <h6 id="livePreviewTitle" class="text-center">Nombre de categoría</h6>
                                            <p id="livePreviewDescription" class="text-center">Descripción de la categoría</p>
                                            <div class="text-center mt-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Así se verá tu categoría
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tips adicionales -->
                                    <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 8px;">
                                        <h6 class="text-muted mb-2">
                                            <i class="fas fa-star me-1"></i>Recomendaciones
                                        </h6>
                                        <ul class="list-unstyled mb-0 small text-muted">
                                            <li class="mb-1">• <strong>Imágenes:</strong> 300x300px mínimo</li>
                                            <li class="mb-1">• <strong>Formato:</strong> JPG o PNG preferible</li>
                                            <li class="mb-1">• <strong>Nombres:</strong> Máximo 25 caracteres</li>
                                            <li class="mb-0">• <strong>Descripción:</strong> 50-100 caracteres</li>
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
    const descriptionInput = document.getElementById('description');
    const photoInput = document.getElementById('photo');
    const imagePreview = document.getElementById('imagePreview');
    const previewText = document.getElementById('previewText');
    
    // Elementos de vista previa en vivo
    const livePreviewTitle = document.getElementById('livePreviewTitle');
    const livePreviewDescription = document.getElementById('livePreviewDescription');
    const livePreviewImage = document.getElementById('livePreviewImage');

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
                livePreviewImage.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px;" alt="Preview">`;
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            previewText.textContent = 'Selecciona una imagen para ver la vista previa';
            livePreviewImage.innerHTML = '<i class="fas fa-image fa-2x text-muted"></i>';
        }
    });

    // Vista previa en vivo del título
    titleInput.addEventListener('input', function(e) {
        const value = e.target.value.trim();
        livePreviewTitle.textContent = value || 'Nombre de categoría';
    });

    // Vista previa en vivo de la descripción
    descriptionInput.addEventListener('input', function(e) {
        const value = e.target.value.trim();
        livePreviewDescription.textContent = value || 'Descripción de la categoría';
    });

    // Validación mejorada del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = ['title', 'photo'];
        let isValid = true;
        let errorMessages = [];
        
        requiredFields.forEach(field => {
            const input = document.getElementById(field);
            if ((field === 'photo' && !input.files[0]) || (field !== 'photo' && !input.value.trim())) {
                input.classList.add('is-invalid');
                isValid = false;
                
                if (field === 'title') {
                    errorMessages.push('• Nombre de categoría es obligatorio');
                } else if (field === 'photo') {
                    errorMessages.push('• La imagen es obligatoria');
                }
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        // Validaciones adicionales
        if (titleInput.value.length > 25) {
            titleInput.classList.add('is-invalid');
            errorMessages.push('• El nombre no debe exceder 25 caracteres');
            isValid = false;
        }
        
        if (descriptionInput.value.length > 100) {
            descriptionInput.classList.add('is-invalid');
            errorMessages.push('• La descripción no debe exceder 100 caracteres');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('⚠️ Por favor corrija los siguientes errores:\n\n' + errorMessages.join('\n'));
        }
    });

    // Animación de entrada
    const sections = document.querySelectorAll('.form-section, .category-preview');
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
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

.current-image {
    border: 3px solid #e9ecef;
    border-radius: 15px;
    padding: 10px;
    background: white;
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

.current-info {
    background: #e3f2fd;
    border: 1px solid #bbdefb;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
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
                                    <i class="fas fa-edit me-2"></i>Editar Categoría
                                </h4>
                                <p class="text-muted mb-0 small">Modificar información de la categoría: <strong>{{$proposals->name}}</strong></p>
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
                            <!-- Información actual -->
                            <div class="current-info">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Editando categoría: {{$proposals->name}} (ID: {{$proposals->id}})</strong>
                                </div>
                                <small class="text-muted">Los cambios se aplicarán inmediatamente al guardar</small>
                            </div>

                            <form action="{{URL::to('updatemodules')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$proposals->id}}" name="id">

                                <!-- Sección: Información Básica -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-layer-group text-primary"></i>Información de Categoría
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="title" name="title" 
                                                       value="{{old('title',$proposals->name)}}" required placeholder="Nombre de categoría">
                                                <label for="title">Nombre de Categoría *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="description" name="description" 
                                                       value="{{old('description',$proposals->description)}}" placeholder="Descripción">
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
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-3">Imagen Actual</h6>
                                                <div class="current-image">
                                                    @if($proposals->photo)
                                                        <img id="currentImage" 
                                                             src="{{ asset('mydoc/' . $proposals->photo) }}" 
                                                             class="img-fluid rounded" style="max-width: 150px; max-height: 150px;" alt="Imagen actual">
                                                    @else
                                                        <div class="d-flex align-items-center justify-content-center" 
                                                             style="width: 150px; height: 150px; background: #f8f9fa; border-radius: 10px;">
                                                            <i class="fas fa-image fa-2x text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if($proposals->photo)
                                                    <small class="text-muted d-block mt-2">{{$proposals->photo}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="upload-area">
                                                <input type="file" class="form-control" id="photo" name="photo" 
                                                       accept="image/*" style="opacity: 0; position: absolute; z-index: -1;">
                                                <label for="photo" style="cursor: pointer; width: 100%;">
                                                    <i class="fas fa-sync-alt fa-2x text-success mb-2"></i>
                                                    <p class="mb-0"><strong>Cambiar Imagen</strong></p>
                                                    <p class="text-muted small mb-0">JPG, PNG, GIF (máx. 5MB)</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-3">Vista Previa</h6>
                                                <div class="preview-container">
                                                    <img id="imagePreview" src="" alt="Vista previa" 
                                                         style="max-width: 150px; max-height: 150px; display: none;" class="img-thumbnail">
                                                    <p id="previewText" class="text-muted small mt-2 mb-0">Selecciona una nueva imagen para ver la vista previa</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de Acción -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-update text-white btn-lg">
                                        <i class="fas fa-save me-2"></i>Actualizar Categoría
                                    </button>
                                    <a href="{{URL::to('modules')}}" class="btn btn-outline-secondary btn-lg ms-3">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                </div>
                            </form>

                            <!-- JavaScript para funcionalidad mejorada -->
                            <script>
                            // Vista previa de imagen
                            document.getElementById('photo').addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                const preview = document.getElementById('imagePreview');
                                const previewText = document.getElementById('previewText');
                                
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block';
                                        previewText.textContent = 'Nueva imagen seleccionada: ' + file.name;
                                    }
                                    reader.readAsDataURL(file);
                                } else {
                                    preview.style.display = 'none';
                                    previewText.textContent = 'Selecciona una nueva imagen para ver la vista previa';
                                }
                            });
                            
                            // Validación de formulario
                            document.querySelector('form').addEventListener('submit', function(e) {
                                const title = document.getElementById('title');
                                let isValid = true;
                                
                                if (!title.value.trim()) {
                                    title.classList.add('is-invalid');
                                    isValid = false;
                                } else {
                                    title.classList.remove('is-invalid');
                                }
                                
                                if (!isValid) {
                                    e.preventDefault();
                                    alert('⚠️ Por favor complete el nombre de la categoría');
                                }
                            });
                            
                            // Actualización en tiempo real del preview de información
                            document.getElementById('title').addEventListener('input', function(e) {
                                const currentInfo = document.querySelector('.current-info strong');
                                const newText = `Editando categoría: ${e.target.value || '{{$proposals->name}}'} (ID: {{$proposals->id}})`;
                                currentInfo.textContent = newText;
                            });
                            </script>

                        </div>
                    </div>
                </div>  
            </div>
        </div>                
    </div>
</div>

@endsection
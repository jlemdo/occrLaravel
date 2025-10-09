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
}

.current-image {
    border: 3px solid #e9ecef;
    border-radius: 15px;
    padding: 10px;
    background: white;
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
                                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                                </h4>
                                <p class="text-muted mb-0 small">Modificar información de: <strong>{{$user->first_name.' '.$user->last_name}}</strong></p>
                            </div>
                            <div class="col col-md-auto">
                                <a href="{{route('admin.allsalereps')}}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4">
                            <form action="{{URL::to('updateuser')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">

                                <!-- Sección: Información Personal -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-user text-primary"></i>Información Personal
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                                       value="{{old('first_name',$user->first_name)}}" required placeholder="Nombre">
                                                <label for="first_name">Nombre *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                                       value="{{old('last_name',$user->last_name)}}" required placeholder="Apellido">
                                                <label for="last_name">Apellido *</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección: Información de Contacto -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-address-book text-success"></i>Información de Contacto
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email" name="email" 
                                                       value="{{old('email',$user->email)}}" required placeholder="Email">
                                                <label for="email">Correo Electrónico *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control" id="contact_number" name="contact_number" 
                                                       value="{{old('contact_number',$user->phone)}}" required placeholder="Teléfono">
                                                <label for="contact_number">Número de Teléfono *</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección: Configuración de Cuenta -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-cog text-warning"></i>Configuración de Cuenta
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="usertype" name="usertype" required>
                                                    <option value="driver" @if($user->usertype=='driver') selected @endif>🚚 Conductor</option>
                                                    <option value="customer" @if($user->usertype=='customer') selected @endif>🛒 Cliente</option>
                                                </select>
                                                <label for="usertype">Tipo de Usuario *</label>
                                            </div>
                                        </div>
                                        @if($user->usertype !='driver')
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select" id="promotion_id" name="promotion_id">
                                                    <option value="0">Sin Promoción</option>
                                                    @foreach($promo as $prm)
                                                    <option value="{{$prm->id}}" @if($user->promotion_id==$prm->id) selected @endif>
                                                        🎯 {{$prm->name}} - 
                                                        @if($prm->discount_type === 'fixed')
                                                            ${{number_format($prm->discount, 0)}}
                                                        @else
                                                            {{$prm->discount}}%
                                                        @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label for="promotion_id">Promoción Asignada</label>
                                            </div>
                                        </div>
                                        @else
                                        <input type="hidden" name="promotion_id" value="{{$user->promotion_id}}">
                                        @endif
                                    </div>
                                </div>
									
                                 
                                     
                                <!-- Sección: Información Adicional -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-info-circle text-info"></i>Información Adicional
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="address" name="address" 
                                                         placeholder="Dirección" style="height: 100px">{{old('address',$user->address)}}</textarea>
                                                <label for="address">Dirección</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="intro" name="intro" 
                                                         placeholder="Introducción" style="height: 100px">{{old('intro',$user->intro)}}</textarea>
                                                <label for="intro">Introducción / Notas</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección: Foto de Perfil -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-camera text-secondary"></i>Actualizar Foto de Perfil
                                    </h5>
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-3">Imagen Actual</h6>
                                                <div class="current-image">
                                                    <img id="currentImage" 
                                                         src="@if($user->image) {{asset('profile/'.$user->image)}} @else {{asset('profile/avatar.png')}} @endif" 
                                                         class="img-fluid rounded" style="max-width: 150px; max-height: 150px;" alt="Imagen actual">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="upload-area">
                                                <input type="file" class="form-control" id="profile_photo" name="profile_photo" 
                                                       accept="image/*" style="opacity: 0; position: absolute; z-index: -1;">
                                                <label for="profile_photo" style="cursor: pointer; width: 100%;">
                                                    <i class="fas fa-sync-alt fa-2x text-success mb-2"></i>
                                                    <p class="mb-0"><strong>Cambiar Imagen</strong></p>
                                                    <p class="text-muted small mb-0">JPG, PNG, GIF (máx. 5MB)</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-3">Vista Previa</h6>
                                                <img id="imagePreview" src="" alt="Vista previa" 
                                                     style="max-width: 150px; max-height: 150px; display: none;" class="img-thumbnail">
                                                <p id="previewText" class="text-muted small mt-2">Selecciona una nueva imagen</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  
                                      
                                       
                                      
                                       
                                    </div>
                                    
                                 
                                    
                                  

                                   

                                </div>

                               <!-- Botones de Acción -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-update text-white btn-lg">
                                        <i class="fas fa-save me-2"></i>Actualizar Usuario
                                    </button>
                                    <a href="{{route('admin.allsalereps')}}" class="btn btn-outline-secondary btn-lg ms-3">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                </div>
                            </form>

                            <!-- JavaScript para funcionalidad mejorada -->
                            <script>
                            // Vista previa de imagen
                            document.getElementById('profile_photo').addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                const preview = document.getElementById('imagePreview');
                                const previewText = document.getElementById('previewText');
                                
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block';
                                        previewText.textContent = 'Nueva imagen seleccionada';
                                    }
                                    reader.readAsDataURL(file);
                                } else {
                                    preview.style.display = 'none';
                                    previewText.textContent = 'Selecciona una nueva imagen';
                                }
                            });
                            
                            // Validación de formulario
                            document.querySelector('form').addEventListener('submit', function(e) {
                                const requiredFields = ['first_name', 'last_name', 'email', 'contact_number', 'usertype'];
                                let isValid = true;
                                
                                requiredFields.forEach(field => {
                                    const input = document.getElementById(field);
                                    if (!input.value.trim()) {
                                        input.classList.add('is-invalid');
                                        isValid = false;
                                    } else {
                                        input.classList.remove('is-invalid');
                                    }
                                });
                                
                                if (!isValid) {
                                    e.preventDefault();
                                    alert('⚠️ Por favor complete todos los campos obligatorios marcados con *');
                                }
                            });
                            
                            // Toggle promoción según tipo de usuario
                            document.getElementById('usertype').addEventListener('change', function(e) {
                                const promotionSection = document.querySelector('[name="promotion_id"]')?.closest('.col-md-6');
                                if (promotionSection) {
                                    if (e.target.value === 'driver') {
                                        promotionSection.style.display = 'none';
                                    } else {
                                        promotionSection.style.display = 'block';
                                    }
                                }
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
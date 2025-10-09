@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.category-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.category-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #0d6efd;
}

.category-image {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 8px;
}

.category-header {
    padding: 1.25rem;
    border-bottom: 1px solid #f0f0f0;
}

.category-body {
    padding: 1.25rem;
}

.category-title {
    font-weight: 600;
    font-size: 1.1rem;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.category-description {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 1rem;
}

.category-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
    margin-top: 1rem;
}

.search-container {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    margin-bottom: 2rem;
}

.search-input {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.btn-add-new {
    background: #0d6efd;
    border: 1px solid #0d6efd;
    color: white;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-add-new:hover {
    background: #0b5ed7;
    border-color: #0a58ca;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    color: white;
}

.btn-edit {
    background: #17a2b8;
    border: 1px solid #17a2b8;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.btn-edit:hover {
    background: #138496;
    border-color: #117a8b;
    color: white;
    transform: translateY(-1px);
}

.btn-delete {
    background: #dc3545;
    border: 1px solid #dc3545;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background: #c82333;
    border-color: #bd2130;
    transform: translateY(-1px);
}

.stats-container {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    flex: 1;
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.no-results {
    text-align: center;
    padding: 3rem;
    color: #6c757d;
}

@media (max-width: 768px) {
    .category-card {
        margin-bottom: 1rem;
    }
    
    .stats-container {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .search-container {
        padding: 1rem;
    }
}
</style>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12">
            <!-- Header -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header p-4 border-bottom" style="background: white; border: 1px solid #dee2e6; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    <div class="row g-3 justify-content-between align-items-center">
                        <div class="col-12 col-md">
                            <h4 class="text-dark mb-0">
                                <i class="fas fa-layer-group me-2"></i>Categorías de Productos
                            </h4>
                            <p class="text-muted mb-0 small">Gestiona las categorías de productos de tu tienda</p>
                        </div>
                        <div class="col col-md-auto">
                            <a href="{{URL::to('newmodules')}}" class="btn btn-add-new">
                                <i class="fas fa-plus me-2"></i>Nueva Categoría
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number">{{ count($projects) }}</div>
                    <div class="stat-label">Total Categorías</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $projects->where('photo', '!=', '')->count() }}</div>
                    <div class="stat-label">Con Imagen</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $projects->where('description', '!=', '')->count() }}</div>
                    <div class="stat-label">Con Descripción</div>
                </div>
            </div>

            <!-- Buscador -->
            <div class="search-container">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute" style="left: 1rem; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                            <input type="text" id="searchInput" class="form-control search-input" 
                                   placeholder="Buscar categorías por nombre o descripción..." 
                                   style="padding-left: 2.5rem;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select id="sortSelect" class="form-select search-input">
                            <option value="name-asc">Ordenar por Nombre (A-Z)</option>
                            <option value="name-desc">Ordenar por Nombre (Z-A)</option>
                            <option value="recent">Más Recientes</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Grid de Categorías -->
            <div class="row g-4" id="categoriesGrid">
                @foreach ($projects as $project)
                <div class="col-12 col-sm-6 col-lg-4 category-item" 
                     data-name="{{ strtolower($project->name) }}" 
                     data-description="{{ strtolower($project->description) }}">
                    <div class="category-card">
                        <div class="category-header">
                            <div class="text-center">
                                @if($project->photo)
                                    <img src="{{ asset('mydoc/' . $project->photo) }}" 
                                         alt="{{ $project->name }}" 
                                         class="category-image">
                                @else
                                    <div class="d-flex align-items-center justify-content-center category-image" 
                                         style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="category-body">
                            <h6 class="category-title">{{ $project->name }}</h6>
                            <p class="category-description">
                                {{ $project->description ?: 'Sin descripción disponible' }}
                            </p>
                            
                            <div class="category-meta">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>ID: {{ $project->id }}
                                </small>
                                <div class="btn-group" role="group">
                                    <a href="{{URL::to('modulesEdit/'.$project->id)}}" 
                                       class="btn btn-edit btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline" id="destroy-data-{{ $project->id }}"
                                          action="{{ route('deletemodules', $project->id)}}"
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');"
                                          method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-delete btn-sm" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Mensaje cuando no hay resultados -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="fas fa-search fa-3x mb-3" style="color: #e9ecef;"></i>
                <h5 class="text-muted">No se encontraron categorías</h5>
                <p class="text-muted">Intenta con otros términos de búsqueda</p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para funcionalidad mejorada -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const categoriesGrid = document.getElementById('categoriesGrid');
    const noResults = document.getElementById('noResults');
    const categoryItems = document.querySelectorAll('.category-item');

    // Función de búsqueda
    function filterCategories() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        categoryItems.forEach(item => {
            const name = item.dataset.name;
            const description = item.dataset.description;
            const matches = name.includes(searchTerm) || description.includes(searchTerm);
            
            if (matches) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Mostrar/ocultar mensaje de no resultados
        if (visibleCount === 0) {
            noResults.style.display = 'block';
            categoriesGrid.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            categoriesGrid.style.display = 'flex';
        }
    }

    // Función de ordenamiento
    function sortCategories() {
        const sortValue = sortSelect.value;
        const items = Array.from(categoryItems);
        const container = categoriesGrid;

        items.sort((a, b) => {
            const aName = a.dataset.name;
            const bName = b.dataset.name;
            
            switch(sortValue) {
                case 'name-asc':
                    return aName.localeCompare(bName);
                case 'name-desc':
                    return bName.localeCompare(aName);
                default:
                    return 0;
            }
        });

        // Reordenar elementos en el DOM
        items.forEach(item => container.appendChild(item));
    }

    // Event listeners
    searchInput.addEventListener('input', filterCategories);
    sortSelect.addEventListener('change', sortCategories);

    // Animación de entrada
    categoryItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        setTimeout(() => {
            item.style.transition = 'all 0.3s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

@endsection
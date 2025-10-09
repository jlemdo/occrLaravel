@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.product-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
    margin-bottom: 1.5rem;
    position: relative;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #0d6efd;
}

.product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #f0f0f0;
}

.product-body {
    padding: 1.25rem;
}

.product-title {
    font-weight: 600;
    font-size: 1.1rem;
    color: #2d3748;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.product-category {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 0.75rem;
}

.product-quantity {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    padding: 0.5rem;
    border-radius: 6px;
    font-size: 0.9rem;
    text-align: center;
    margin-bottom: 1rem;
}

.product-prices {
    display: flex;
    justify-content: space-between;
    align-items-center;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
    margin-top: 1rem;
}

.price-public {
    font-size: 1.2rem;
    font-weight: 700;
    color: #28a745;
}

.price-cost {
    font-size: 0.9rem;
    color: #6c757d;
    text-decoration: line-through;
}

.price-discount {
    font-size: 0.9rem;
    color: #dc3545;
    font-weight: 600;
}

.product-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    opacity: 0;
    transition: all 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
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
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    font-size: 0.8rem;
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
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background: #c82333;
    border-color: #bd2130;
    transform: translateY(-1px);
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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

.filter-tabs {
    background: white;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
    margin-bottom: 2rem;
}

.filter-tab {
    background: transparent;
    border: 1px solid #e9ecef;
    color: #6c757d;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    margin: 0.25rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-tab.active,
.filter-tab:hover {
    background: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

@media (max-width: 768px) {
    .product-card {
        margin-bottom: 1rem;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .search-container {
        padding: 1rem;
    }
    
    .product-actions {
        opacity: 1;
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
                                <i class="fas fa-box-open me-2"></i>Gestión de Productos
                            </h4>
                            <p class="text-muted mb-0 small">Administra el catálogo completo de productos de tu tienda</p>
                        </div>
                        <div class="col col-md-auto">
                            <a href="{{URL::to('newinverter')}}" class="btn btn-add-new">
                                <i class="fas fa-plus me-2"></i>Nuevo Producto
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number">{{ count($projects) }}</div>
                    <div class="stat-label">Total Productos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $projects->unique('product_cat')->count() }}</div>
                    <div class="stat-label">Categorías</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">${{ number_format($projects->avg('price'), 0) }}</div>
                    <div class="stat-label">Precio Promedio</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $projects->where('discount', '>', 0)->count() }}</div>
                    <div class="stat-label">Con Descuento</div>
                </div>
            </div>

            <!-- Filtros por categoría -->
            <div class="filter-tabs">
                <div class="d-flex flex-wrap align-items-center">
                    <strong class="me-3 text-muted">Filtrar por categoría:</strong>
                    <button class="filter-tab active" data-category="all">Todos</button>
                    @foreach($projects->unique('product_cat')->sortBy('product_cat') as $project)
                        @if($project->product_cat)
                            <button class="filter-tab" data-category="{{ $project->product_cat }}">{{ $project->product_cat }}</button>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Buscador -->
            <div class="search-container">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute" style="left: 1rem; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                            <input type="text" id="searchInput" class="form-control search-input" 
                                   placeholder="Buscar productos por nombre, categoría o descripción..." 
                                   style="padding-left: 2.5rem;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select id="sortSelect" class="form-select search-input">
                            <option value="name-asc">Nombre (A-Z)</option>
                            <option value="name-desc">Nombre (Z-A)</option>
                            <option value="price-asc">Precio Menor</option>
                            <option value="price-desc">Precio Mayor</option>
                            <option value="category-asc">Categoría (A-Z)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="priceFilter" class="form-select search-input">
                            <option value="all">Todos los precios</option>
                            <option value="0-50">$0 - $50</option>
                            <option value="50-100">$50 - $100</option>
                            <option value="100-200">$100 - $200</option>
                            <option value="200+">$200+</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Grid de Productos -->
            <div class="row g-4" id="productsGrid">
                @foreach ($projects as $project)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 product-item" 
                     data-name="{{ strtolower($project->name) }}" 
                     data-category="{{ $project->product_cat }}"
                     data-description="{{ strtolower($project->description) }}"
                     data-price="{{ $project->price }}">
                    <div class="product-card">
                        <div class="product-actions">
                            <div class="btn-group" role="group">
                                <a href="{{URL::to('inverterEdit/'.$project->id)}}" 
                                   class="btn btn-edit btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="d-inline" id="destroy-data-{{ $project->id }}"
                                      action="{{ route('deleteinverter', $project->id)}}"
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');"
                                      method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-delete btn-sm" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        @if($project->photo)
                            <img src="{{ asset('mydoc/'.$project->photo) }}" 
                                 alt="{{ $project->name }}" 
                                 class="product-image">
                        @else
                            <div class="d-flex align-items-center justify-content-center product-image" 
                                 style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <i class="fas fa-box fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="product-body">
                            <div class="product-category">{{ $project->product_cat }}</div>
                            <h6 class="product-title">{{ $project->name }}</h6>
                            
                            @if($project->description)
                                <p class="text-muted small mb-2">{{ Str::limit($project->description, 60) }}</p>
                            @endif
                            
                            <div class="product-quantity">
                                <strong>
                                @if($project->quantity)
                                    @php
                                        $quantity = floatval($project->quantity);
                                        $unit = strtolower($project->unit);
                                        $formattedQuantity = $quantity == intval($quantity) ? intval($quantity) : $quantity;
                                        $unitTranslations = [
                                            'pieces' => ($formattedQuantity == 1) ? 'pieza' : 'piezas',
                                            'gr' => 'gr', 'kg' => 'kg', 'ml' => 'ml', 'l' => 'l'
                                        ];
                                        $translatedUnit = $unitTranslations[$unit] ?? $unit;
                                    @endphp
                                    {{ $formattedQuantity }} {{ $translatedUnit }}
                                @else
                                    {{ $project->unit ?? 'No definida' }}
                                @endif
                                </strong>
                            </div>
                            
                            <div class="product-prices">
                                <div>
                                    <div class="price-public">${{ number_format($project->price, 0) }}</div>
                                    @if($project->cost && $project->cost > 0)
                                        <div class="price-cost">${{ number_format($project->cost, 0) }}</div>
                                    @endif
                                </div>
                                @if($project->discount && $project->discount > 0)
                                    <div class="price-discount">
                                        <i class="fas fa-tag me-1"></i>-${{ number_format($project->discount, 0) }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-barcode me-1"></i>ID: {{ $project->id }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Mensaje cuando no hay resultados -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="fas fa-search fa-3x mb-3" style="color: #e9ecef;"></i>
                <h5 class="text-muted">No se encontraron productos</h5>
                <p class="text-muted">Intenta con otros términos de búsqueda o filtros</p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para funcionalidad mejorada -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const priceFilter = document.getElementById('priceFilter');
    const productsGrid = document.getElementById('productsGrid');
    const noResults = document.getElementById('noResults');
    const productItems = document.querySelectorAll('.product-item');
    const filterTabs = document.querySelectorAll('.filter-tab');
    
    let currentCategory = 'all';

    // Función de filtrado y búsqueda
    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const priceRange = priceFilter.value;
        let visibleCount = 0;

        productItems.forEach(item => {
            const name = item.dataset.name;
            const category = item.dataset.category;
            const description = item.dataset.description;
            const price = parseFloat(item.dataset.price);
            
            // Filtro de búsqueda
            const matchesSearch = name.includes(searchTerm) || 
                                description.includes(searchTerm) || 
                                category.toLowerCase().includes(searchTerm);
            
            // Filtro de categoría
            const matchesCategory = currentCategory === 'all' || category === currentCategory;
            
            // Filtro de precio
            let matchesPrice = true;
            if (priceRange !== 'all') {
                const [min, max] = priceRange.split('-');
                if (max === undefined) { // 200+
                    matchesPrice = price >= parseInt(min);
                } else {
                    matchesPrice = price >= parseInt(min) && price <= parseInt(max);
                }
            }
            
            if (matchesSearch && matchesCategory && matchesPrice) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Mostrar/ocultar mensaje de no resultados
        if (visibleCount === 0) {
            noResults.style.display = 'block';
            productsGrid.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            productsGrid.style.display = 'flex';
        }
    }

    // Función de ordenamiento
    function sortProducts() {
        const sortValue = sortSelect.value;
        const items = Array.from(productItems);
        const container = productsGrid;

        items.sort((a, b) => {
            const aName = a.dataset.name;
            const bName = b.dataset.name;
            const aPrice = parseFloat(a.dataset.price);
            const bPrice = parseFloat(b.dataset.price);
            const aCategory = a.dataset.category;
            const bCategory = b.dataset.category;
            
            switch(sortValue) {
                case 'name-asc':
                    return aName.localeCompare(bName);
                case 'name-desc':
                    return bName.localeCompare(aName);
                case 'price-asc':
                    return aPrice - bPrice;
                case 'price-desc':
                    return bPrice - aPrice;
                case 'category-asc':
                    return aCategory.localeCompare(bCategory);
                default:
                    return 0;
            }
        });

        items.forEach(item => container.appendChild(item));
    }

    // Event listeners
    searchInput.addEventListener('input', filterProducts);
    sortSelect.addEventListener('change', () => {
        sortProducts();
        filterProducts();
    });
    priceFilter.addEventListener('change', filterProducts);

    // Filtros de categoría
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            filterProducts();
        });
    });

    // Animación de entrada
    productItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        setTimeout(() => {
            item.style.transition = 'all 0.3s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 50);
    });
});
</script>

@endsection
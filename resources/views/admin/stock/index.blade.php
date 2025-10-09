@extends('layouts.app')
@section('section')

<!-- Estilos personalizados siguiendo el patrón homologado -->
<style>
.stats-card {
    background: white;
    color: #495057;
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
    margin-bottom: 1rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-container {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-box {
    position: relative;
    max-width: 500px;
}

.search-input {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 1rem 3rem 1rem 1rem;
    font-size: 0.95rem;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #0d6efd;
    background: white;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1), inset 0 2px 4px rgba(0,0,0,0.05);
    outline: none;
}

.search-box-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1.1rem;
    pointer-events: none;
    transition: all 0.3s ease;
}

.search-input:focus + .search-box-icon {
    color: #0d6efd;
}

.search-stats {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.75rem;
    font-size: 0.875rem;
    color: #6c757d;
}

.search-hint {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
}

.table-container {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

.modern-table {
    margin-bottom: 0;
}

.modern-table thead th {
    background: #f8f9fa;
    border: none;
    border-bottom: 2px solid #dee2e6;
    padding: 1rem 0.75rem;
    font-weight: 600;
    font-size: 0.875rem;
    color: #495057;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.modern-table thead th:hover {
    background: #e9ecef;
    color: #0d6efd;
}

.modern-table thead th.sortable:after {
    content: '↕';
    position: absolute;
    right: 0.5rem;
    opacity: 0.3;
    font-size: 0.75rem;
}

.modern-table thead th.sort-asc:after {
    content: '↑';
    opacity: 1;
    color: #0d6efd;
}

.modern-table thead th.sort-desc:after {
    content: '↓';
    opacity: 1;
    color: #0d6efd;
}

.modern-table tbody tr {
    border: none;
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
    background: #f8f9fa;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.modern-table tbody td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border: none;
}

.stock-badge {
    font-size: 0.75rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.status-high {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.status-medium {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    color: white;
}

.status-low {
    background: linear-gradient(45deg, #dc3545, #e83e8c);
    color: white;
}

.status-empty {
    background: #6c757d;
    color: white;
}

.quantity-cell {
    font-size: 1.1rem;
    font-weight: 600;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.product-icon {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.icon-high { background: linear-gradient(135deg, #e8f5e8 0%, #f1f8e9 100%); color: #28a745; }
.icon-medium { background: linear-gradient(135deg, #fff3cd 0%, #fef3c7 100%); color: #ffc107; }
.icon-low { background: linear-gradient(135deg, #f8d7da 0%, #fecaca 100%); color: #dc3545; }
.icon-empty { background: #f5f5f5; color: #6c757d; }

.action-dropdown .dropdown-menu {
    border-radius: 10px;
    border: none;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    padding: 0.5rem;
}

.action-dropdown .dropdown-item {
    border-radius: 6px;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action-dropdown .dropdown-item:hover {
    background: #f8f9fa;
    transform: translateX(3px);
}

.no-results {
    text-align: center;
    padding: 3rem 1rem;
    color: #6c757d;
}

@media (max-width: 768px) {
    .table-container {
        padding: 1rem;
        margin: 0 -15px;
        border-radius: 0;
    }
    
    .modern-table {
        font-size: 0.875rem;
    }
}
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">📦 Gestión de Inventario</h2>
            <p class="text-muted mb-0">Control y seguimiento del stock de productos</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="stats-card">
                    <div class="fw-bold fs-4">{{ count($projects) }}</div>
                    <small>Total Items</small>
                </div>
                <a href="{{ URL::to('newstock') }}" class="btn btn-primary">
                    <span class="fas fa-plus me-2"></span>Agregar Stock
                </a>
            </div>
        </div>
    </div>

    <!-- Buscador -->
    <div class="search-container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="mb-3 d-flex align-items-center gap-2">
                    <i class="fas fa-search text-primary"></i>
                    Buscar Productos
                </h5>
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" 
                               placeholder="Buscar por producto, cantidad, estado..." aria-label="Search" 
                               id="searchInput" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="search-stats">
                        <span class="search-hint">💡 Búsqueda en tiempo real</span>
                        <small id="search-results">Mostrando {{ count($projects) }} productos en stock</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex flex-column align-items-end gap-2">
                    <div class="d-flex gap-2">
                        <span class="badge bg-success">{{ $projects->where('qty', '>', 10)->count() }} Alto</span>
                        <span class="badge bg-warning">{{ $projects->where('qty', '<=', 10)->where('qty', '>', 0)->count() }} Bajo</span>
                        <span class="badge bg-danger">{{ $projects->where('qty', '<=', 0)->count() }} Agotado</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Moderna -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table modern-table" id="stockTable">
                <thead>
                    <tr>
                        <th class="sortable" data-sort="name">Producto</th>
                        <th class="sortable text-center" data-sort="quantity">Cantidad</th>
                        <th class="sortable text-center" data-sort="status">Estado</th>
                        <th class="sortable" data-sort="date">Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="stockTableBody">
                    @foreach ($projects as $project)
                    @php
                        $status = 'empty';
                        if ($project->qty > 10) $status = 'high';
                        elseif ($project->qty > 5) $status = 'medium';
                        elseif ($project->qty > 0) $status = 'low';
                    @endphp
                    <tr class="stock-row" 
                        data-name="{{ strtolower($project->product) }}" 
                        data-qty="{{ $project->qty }}"
                        data-status="{{ $status }}">
                        
                        <!-- Producto -->
                        <td>
                            <div class="product-info">
                                <div class="product-icon icon-{{ $status }}">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $project->product }}</div>
                                    <small class="text-muted">ID: {{ $project->id }}</small>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Cantidad -->
                        <td class="text-center">
                            <div class="quantity-cell 
                                @if($status == 'high') text-success 
                                @elseif($status == 'medium') text-warning 
                                @elseif($status == 'low') text-danger 
                                @else text-muted @endif">
                                {{ number_format($project->qty) }}
                            </div>
                            <small class="text-muted">unidades</small>
                        </td>
                        
                        <!-- Estado -->
                        <td class="text-center">
                            @if($project->qty > 10)
                                <span class="stock-badge status-high">
                                    <i class="fas fa-check-circle"></i>DISPONIBLE
                                </span>
                            @elseif($project->qty > 5)
                                <span class="stock-badge status-medium">
                                    <i class="fas fa-exclamation-circle"></i>MEDIO
                                </span>
                            @elseif($project->qty > 0)
                                <span class="stock-badge status-low">
                                    <i class="fas fa-exclamation-triangle"></i>BAJO
                                </span>
                            @else
                                <span class="stock-badge status-empty">
                                    <i class="fas fa-times-circle"></i>AGOTADO
                                </span>
                            @endif
                        </td>
                        
                        <!-- Fecha -->
                        <td>
                            <div class="fw-semibold">{{ $project->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $project->created_at->format('H:i') }}</small>
                        </td>
                        
                        <!-- Acciones -->
                        <td class="text-center">
                            <div class="dropdown action-dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" 
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ URL::to('stockEdit/'.$project->id) }}">
                                            <i class="fas fa-edit text-primary"></i>Editar Stock
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('deletestock', $project->id) }}" method="post" 
                                              class="d-inline" onsubmit="return confirmDelete('{{ $project->product }}')">
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">
                                                <i class="fas fa-trash"></i>Eliminar
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mensaje cuando no hay resultados -->
        <div id="no-results" class="no-results" style="display: none;">
            <i class="fas fa-search fa-3x mb-3 text-muted opacity-50"></i>
            <h5 class="text-muted">No se encontraron productos</h5>
            <p class="text-muted">Intenta con otros términos de búsqueda</p>
        </div>
    </div>
</div>

<!-- JavaScript para funcionalidad completa -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const stockRows = document.querySelectorAll('.stock-row');
    const noResults = document.getElementById('no-results');
    const searchResults = document.getElementById('search-results');
    const table = document.getElementById('stockTable');
    const tbody = document.getElementById('stockTableBody');

    // Función de búsqueda
    function filterStock() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        stockRows.forEach(row => {
            const name = row.dataset.name;
            const qty = row.dataset.qty;
            const status = row.dataset.status;
            const matches = name.includes(searchTerm) || qty.includes(searchTerm) || status.includes(searchTerm);
            
            if (matches || searchTerm === '') {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Actualizar estadísticas de búsqueda
        if (searchTerm === '') {
            searchResults.textContent = `Mostrando {{ count($projects) }} productos en stock`;
        } else {
            searchResults.textContent = `Mostrando ${visibleCount} de {{ count($projects) }} productos`;
        }

        // Mostrar/ocultar mensaje de no resultados
        if (visibleCount === 0 && searchTerm !== '') {
            noResults.style.display = 'block';
            table.style.opacity = '0.3';
        } else {
            noResults.style.display = 'none';
            table.style.opacity = '1';
        }
    }

    // Función de ordenamiento
    function sortTable(columnIndex, direction) {
        const rows = Array.from(tbody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');
        
        rows.sort((a, b) => {
            let aValue, bValue;
            
            switch(columnIndex) {
                case 0: // Producto
                    aValue = a.dataset.name;
                    bValue = b.dataset.name;
                    break;
                case 1: // Cantidad
                    aValue = parseInt(a.dataset.qty);
                    bValue = parseInt(b.dataset.qty);
                    break;
                case 2: // Estado
                    const statusOrder = {high: 4, medium: 3, low: 2, empty: 1};
                    aValue = statusOrder[a.dataset.status];
                    bValue = statusOrder[b.dataset.status];
                    break;
                case 3: // Fecha
                    aValue = new Date(a.cells[3].querySelector('.fw-semibold').textContent);
                    bValue = new Date(b.cells[3].querySelector('.fw-semibold').textContent);
                    break;
                default:
                    return 0;
            }
            
            if (typeof aValue === 'string') {
                return direction === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            } else {
                return direction === 'asc' ? aValue - bValue : bValue - aValue;
            }
        });

        // Reordenar filas en el DOM
        rows.forEach(row => tbody.appendChild(row));
    }

    // Event listeners
    searchInput.addEventListener('input', filterStock);

    // Sorting para headers
    document.querySelectorAll('.sortable').forEach((th, index) => {
        th.addEventListener('click', function() {
            // Remover clases de sort anteriores
            document.querySelectorAll('.sortable').forEach(header => {
                header.classList.remove('sort-asc', 'sort-desc');
            });
            
            // Determinar dirección
            let direction = 'asc';
            if (this.classList.contains('sort-asc')) {
                direction = 'desc';
                this.classList.add('sort-desc');
            } else {
                this.classList.add('sort-asc');
            }
            
            sortTable(index, direction);
        });
    });

    // Función para confirmación de eliminación
    window.confirmDelete = function(productName) {
        return confirm(`¿Estás seguro de que deseas eliminar "${productName}" del inventario?\n\nEsta acción no se puede deshacer.`);
    };

    // Animación de entrada para las filas
    stockRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, index * 50);
    });
});
</script>

@endsection
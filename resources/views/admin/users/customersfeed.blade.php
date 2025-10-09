@extends('layouts.app')
@section('section')

<!-- Estilos personalizados -->
<style>
.feedback-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.feedback-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.feedback-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f8f9fa;
}

.order-badge {
    background: #e3f2fd;
    color: #1976d2;
    font-size: 0.8rem;
    font-weight: 600;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.order-badge:hover {
    background: #1976d2;
    color: white;
    transform: translateY(-1px);
}

.feedback-message {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    margin: 0.75rem 0;
    border-left: 4px solid #0d6efd;
    line-height: 1.6;
}

.feedback-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.75rem;
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
    border-radius: 12px;
    border: 2px solid #e9ecef;
    padding: 0.75rem 3rem 0.75rem 1.25rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
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

.rating-stars {
    color: #ffc107;
    font-size: 1rem;
    margin: 0.25rem 0;
}

.feedback-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(45deg, #e3f2fd, #bbdefb);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1976d2;
    font-size: 1.1rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
}
</style>

<div class="mt-4">
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-1100 mb-1">💬 Comentarios de Clientes</h2>
            <p class="text-muted mb-0">Gestiona y revisa el feedback de los clientes</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2">
                <div class="stats-card">
                    <div class="fw-bold fs-4">{{$users->total()}}</div>
                    <small>Total Comentarios</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Buscador -->
    <div class="search-container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="mb-3 d-flex align-items-center gap-2">
                    <i class="fas fa-search text-primary"></i>
                    Buscar Comentarios
                </h5>
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" 
                               placeholder="Buscar por número de pedido, mensaje..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="search-stats">
                        <span class="search-hint">💡 Búsqueda en tiempo real</span>
                        <small id="search-results">Mostrando {{$users->count()}} de {{$users->total()}} comentarios</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex flex-column align-items-end gap-2">
                    <small class="text-muted">Página {{$users->currentPage()}} de {{$users->lastPage()}}</small>
                    <div class="d-flex gap-2">
                        <span class="badge bg-success" id="visible-count" style="display: none;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Comentarios -->
    <div class="row">
        @forelse ($users as $feedback)
            <div class="col-12">
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="d-flex align-items-start">
                            <div class="feedback-icon">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Comentario del Cliente</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{URL::to('ordershowd/'.$feedback->orderno)}}" 
                                       class="order-badge" target="_blank">
                                        📋 Pedido #{{$feedback->orderno}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="feedback-meta">
                                <span>
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $feedback->created_at->format('d/m/Y') }}
                                </span>
                                <span>
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $feedback->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mensaje -->
                    <div class="feedback-message">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-quote-left text-muted me-2 mt-1" style="font-size: 0.8rem;"></i>
                            <div class="flex-grow-1">
                                <p class="mb-0">{{ $feedback->message }}</p>
                            </div>
                            <i class="fas fa-quote-right text-muted ms-2 mt-1" style="font-size: 0.8rem;"></i>
                        </div>
                    </div>
                    
                    <!-- Información adicional -->
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                        <div class="feedback-meta">
                            <span>
                                <i class="fas fa-hashtag me-1"></i>
                                ID: {{ $feedback->id }}
                            </span>
                            @if($feedback->rating)
                            <span class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $feedback->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </span>
                            @endif
                        </div>
                        <div>
                            <small class="text-muted">
                                Hace {{ $feedback->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay comentarios registrados</h4>
                    <p class="text-muted">Los comentarios de los clientes aparecerán aquí</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginación Mejorada -->
    @if($users->hasPages())
    <div class="mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        <span class="text-muted">
                            Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }} comentarios
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        @if (!$users->onFirstPage())
                            <a href="{{ $users->previousPageUrl() }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-chevron-left me-1"></i>Anterior
                            </a>
                        @endif
                        
                        <ul class="pagination pagination-sm mb-0">
                            @php
                                $start = max($users->currentPage() - 2, 1);
                                $end = min($start + 4, $users->lastPage());
                                $start = max($end - 4, 1);
                            @endphp
                            
                            @if($start > 1)
                                <li class="page-item">
                                    <a href="{{ $users->url(1) }}" class="page-link">1</a>
                                </li>
                                @if($start > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                            @endif
                            
                            @for ($i = $start; $i <= $end; $i++)
                                <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                                    <a href="{{ $users->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            @if($end < $users->lastPage())
                                @if($end < $users->lastPage() - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a href="{{ $users->url($users->lastPage()) }}" class="page-link">{{ $users->lastPage() }}</a>
                                </li>
                            @endif
                        </ul>
                        
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="btn btn-outline-primary btn-sm ms-2">
                                Siguiente<i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
// Funcionalidad de búsqueda en tiempo real
$(document).ready(function() {
    $('.search-input').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('.feedback-card').each(function() {
            var cardText = $(this).text().toLowerCase();
            if (cardText.includes(searchTerm)) {
                $(this).closest('.col-12').show();
            } else {
                $(this).closest('.col-12').hide();
            }
        });
        
        // Actualizar contadores solo durante búsqueda
        var visibleCards = $('.feedback-card:visible').length;
        var totalCards = $('.feedback-card').length;
        
        if (searchTerm !== '') {
            // Mostrar contador cuando hay búsqueda activa
            $('#visible-count').show().text(visibleCards + ' Encontrados');
            $('#search-results').text('Mostrando ' + visibleCards + ' resultados de "' + searchTerm + '"');
            
            if (visibleCards === 0) {
                if ($('#no-results').length === 0) {
                    $('.row').append(`
                        <div id="no-results" class="col-12 text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No se encontraron comentarios</h4>
                            <p class="text-muted">Intenta con otros términos de búsqueda</p>
                        </div>
                    `);
                }
                $('#visible-count').removeClass('bg-success').addClass('bg-warning');
            } else {
                $('#no-results').remove();
                $('#visible-count').removeClass('bg-warning').addClass('bg-success');
            }
        } else {
            // Ocultar contador cuando no hay búsqueda
            $('#visible-count').hide();
            $('#search-results').text('Mostrando {{$users->count()}} de {{$users->total()}} comentarios');
            $('#no-results').remove();
        }
    });
});
</script>               
@endsection
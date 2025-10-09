@extends('layouts.app')
@section('section')

<!-- Estilos para Notificaciones -->
<style>
.notifications-container {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f8f9fa;
}

.notifications-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.75rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.notification-item {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    position: relative;
}

.notification-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    border-color: #D27F27;
}

.notification-item.unread {
    border-left: 4px solid #D27F27;
    background: linear-gradient(135deg, #fffbf5 0%, #ffffff 100%);
}

.notification-item.read {
    border-left: 4px solid #dee2e6;
    background: #ffffff;
}

.notification-icon {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.25rem;
    margin-right: 1rem;
}

.notification-icon.unread {
    background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
    border-color: #D27F27;
    color: #D27F27;
}

.notification-content {
    flex: 1;
}

.notification-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.notification-message {
    color: #6c757d;
    margin-bottom: 0.75rem;
    line-height: 1.5;
}

.notification-time {
    color: #868e96;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.notification-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-left: 1rem;
}

.btn-notification {
    padding: 0.375rem 0.75rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid #dee2e6;
    background: white;
    color: #495057;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
}

.btn-notification:hover {
    background: #f8f9fa;
    border-color: #D27F27;
    color: #D27F27;
    transform: translateY(-1px);
}

.btn-notification.primary {
    background: #D27F27;
    border-color: #D27F27;
    color: white;
}

.btn-notification.primary:hover {
    background: #b8671f;
    border-color: #b8671f;
    color: white;
}

.empty-notifications {
    text-align: center;
    padding: 3rem 2rem;
    color: #6c757d;
}

.empty-notifications i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #dee2e6;
}

.stats-bar {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.stat-badge {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    color: #495057;
    font-weight: 500;
}

.stat-badge.unread {
    background: #fff3e0;
    border-color: #D27F27;
    color: #D27F27;
}

@media (max-width: 768px) {
    .notifications-container {
        margin: 1rem;
        padding: 1rem;
    }
    
    .notification-item {
        padding: 1rem;
    }
    
    .notifications-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .notification-actions {
        margin-left: 0;
        margin-top: 1rem;
        flex-direction: row;
    }
}
</style>

<div class="container-fluid py-4">
    <div class="notifications-container">
        <!-- Header -->
        <div class="notifications-header">
            <h1 class="notifications-title">
                <i class="fas fa-bell"></i>
                Notificaciones
            </h1>
            
            @php
                $totalNotifications = auth()->user()->notifications->count();
                $unreadNotifications = auth()->user()->unreadNotifications->count();
            @endphp
            
            <div class="stats-bar">
                <div class="stat-badge">
                    {{ $totalNotifications }} Total
                </div>
                @if($unreadNotifications > 0)
                <div class="stat-badge unread">
                    {{ $unreadNotifications }} Sin Leer
                </div>
                @endif
            </div>
        </div>

        <!-- Lista de Notificaciones -->
        <div class="notifications-list">
            @forelse(auth()->user()->notifications as $notification)
                <div class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}">
                    <div class="d-flex">
                        <!-- Ícono -->
                        <div class="notification-icon {{ $notification->read_at ? '' : 'unread' }}">
                            <i class="fas fa-{{ $notification->read_at ? 'check' : 'bell' }}"></i>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="notification-content">
                            <h4 class="notification-title">{{ $notification->data['title'] ?? 'Notificación' }}</h4>
                            <p class="notification-message">
                                {{ $notification->data['message'] ?? 'Sin mensaje' }}
                                
                                @if(isset($notification->data['url']))
                                    <br>
                                    <a href="{{ $notification->data['url'] }}" class="btn-notification primary mt-2" style="display: inline-block;">
                                        <i class="fas fa-external-link-alt me-1"></i>Ver Detalles
                                    </a>
                                @endif
                            </p>
                            <p class="notification-time">
                                <i class="fas fa-clock"></i>
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                        
                        <!-- Acciones -->
                        <div class="notification-actions">
                            @if($notification->read_at)
                                <a href="{{ route('notifications.markAsUNRead', $notification->id) }}" class="btn-notification">
                                    <i class="fas fa-eye-slash me-1"></i>Marcar No Leída
                                </a>
                            @else
                                <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn-notification primary">
                                    <i class="fas fa-check me-1"></i>Marcar Leída
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-notifications">
                    <i class="fas fa-bell-slash"></i>
                    <h3>No tienes notificaciones</h3>
                    <p>Cuando recibas nuevas notificaciones aparecerán aquí.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
       
        
       
@push('scripts')

@endpush
@endsection
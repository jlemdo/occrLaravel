@extends('layouts.app')
@section('section')

<!-- Estilos personalizados siguiendo el patrón homologado -->
<style>
.dashboard-header {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--accent-color, #0d6efd);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1rem;
    background: var(--accent-color, #0d6efd);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--accent-color, #0d6efd);
}

.stat-label {
    color: #6c757d;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.stat-change {
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.change-positive { color: #28a745; }
.change-negative { color: #dc3545; }
.change-neutral { color: #6c757d; }

.section-container {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.section-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f8f9fa;
}

.section-title {
    color: #495057;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

.quick-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-action {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
}

.btn-action:hover {
    transform: translateY(-1px);
}

.alert-item {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-critical {
    background: #f8d7da;
    border-color: #f1aeb5;
}

.alert-success {
    background: #d4edda;
    border-color: #b8dadb;
}

.progress-bar-custom {
    height: 8px;
    border-radius: 4px;
    background: #e9ecef;
    overflow: hidden;
    margin-top: 0.5rem;
}

.progress-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.6s ease;
}

.mini-chart {
    height: 60px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    display: flex;
    align-items: end;
    padding: 0.5rem;
    gap: 2px;
}

.chart-bar {
    background: var(--accent-color, #0d6efd);
    border-radius: 2px;
    flex: 1;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.chart-bar:hover {
    opacity: 1;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header {
        padding: 1.5rem;
    }
    
    .section-container {
        padding: 1rem;
    }
}
</style>

<div class="mt-4">
    <!-- Header Principal -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="text-bold text-1100 mb-2">📊 Dashboard Ejecutivo</h1>
                <p class="text-muted mb-0">Resumen completo de operaciones y métricas clave del negocio</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex flex-column align-items-md-end gap-1">
                    <div class="fw-bold">{{ now()->format('d/m/Y') }}</div>
                    <small class="text-muted">{{ now()->format('H:i') }} - {{ now()->translatedFormat('l') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Control OTP -->
    <div class="section-container">
        <div class="alert alert-info d-flex align-items-center">
            <i class="fas fa-shield-alt fa-2x me-3"></i>
            <div class="flex-grow-1">
                <h6 class="mb-1">🔐 Control Verificación OTP Email</h6>
                <p class="mb-2">Estado: <span id="otp-status" class="badge bg-primary">Cargando...</span></p>
            </div>
            <button id="toggle-otp" class="btn btn-primary" onclick="toggleOTP()">
                <i class="fas fa-toggle-on me-1"></i>Cambiar Estado
            </button>
        </div>
    </div>

    <!-- Métricas Principales -->
    <div class="stats-grid">
        <!-- Pedidos Nuevos -->
        <div class="stat-card" style="--accent-color: #28a745">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            @php
                $newOrders = App\Models\Order::where('status', 'open')->count();
                $yesterdayOrders = App\Models\Order::where('status', 'open')
                    ->whereDate('created_at', now()->subDay())->count();
                $orderChange = $yesterdayOrders > 0 ? (($newOrders - $yesterdayOrders) / $yesterdayOrders) * 100 : 0;
            @endphp
            <div class="stat-number">{{ $newOrders }}</div>
            <div class="stat-label">Pedidos Nuevos</div>
            <div class="stat-change {{ $orderChange >= 0 ? 'change-positive' : 'change-negative' }}">
                <i class="fas fa-{{ $orderChange >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                {{ abs(round($orderChange, 1)) }}% vs ayer
            </div>
        </div>

        <!-- Entregas Hoy -->
        <div class="stat-card" style="--accent-color: #17a2b8">
            <div class="stat-icon">
                <i class="fas fa-truck"></i>
            </div>
            @php
                $deliveredToday = App\Models\Order::where('status', 'Delivered')
                    ->whereDate('updated_at', today())->count();
                $totalToday = App\Models\Order::whereDate('created_at', today())->count();
                $deliveryRate = $totalToday > 0 ? ($deliveredToday / $totalToday) * 100 : 0;
            @endphp
            <div class="stat-number">{{ $deliveredToday }}</div>
            <div class="stat-label">Entregas Hoy</div>
            <div class="stat-change change-positive">
                <i class="fas fa-percentage"></i>
                {{ round($deliveryRate, 1) }}% tasa entrega
            </div>
        </div>

        <!-- Productos Agotados -->
        <div class="stat-card" style="--accent-color: #dc3545">
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            @php
                $outOfStock = App\Models\Inverters::all()->filter(function ($mod) {
                    $totalPurchased = App\Models\Stockweb::where('product', $mod->name)->sum('qty');
                    $totalSold = App\Models\Ordedetail::where('item_name', $mod->name)->sum('item_qty');
                    return ($totalPurchased - $totalSold) <= 0;
                })->count();
                $totalProducts = App\Models\Inverters::count();
                $stockRate = $totalProducts > 0 ? (($totalProducts - $outOfStock) / $totalProducts) * 100 : 100;
            @endphp
            <div class="stat-number">{{ $outOfStock }}</div>
            <div class="stat-label">Sin Stock</div>
            <div class="stat-change {{ $stockRate >= 80 ? 'change-positive' : 'change-negative' }}">
                <i class="fas fa-chart-line"></i>
                {{ round($stockRate, 1) }}% disponible
            </div>
        </div>

        <!-- Drivers Activos -->
        <div class="stat-card" style="--accent-color: #ffc107">
            <div class="stat-icon">
                <i class="fas fa-route"></i>
            </div>
            @php
                $driversActive = App\Models\Order::where('status', 'On the Way')->count();
                $totalDrivers = App\Models\User::where('usertype', 'driver')->where('is_active', 'active')->count();
                $utilizationRate = $totalDrivers > 0 ? ($driversActive / $totalDrivers) * 100 : 0;
            @endphp
            <div class="stat-number">{{ $driversActive }}</div>
            <div class="stat-label">En Ruta</div>
            <div class="stat-change change-neutral">
                <i class="fas fa-users"></i>
                {{ round($utilizationRate, 1) }}% utilización
            </div>
        </div>

        <!-- Ventas del Día -->
        <div class="stat-card" style="--accent-color: #6f42c1">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            @php
                $dailySales = App\Models\Order::whereDate('created_at', today())->sum('total');
                $monthlySales = App\Models\Order::whereMonth('created_at', now()->month)->sum('total');
                $monthlyTarget = 100000; // Meta mensual ejemplo
                $monthProgress = ($monthlySales / $monthlyTarget) * 100;
            @endphp
            <div class="stat-number">${{ number_format($dailySales, 0) }}</div>
            <div class="stat-label">Ventas Hoy</div>
            <div class="stat-change change-positive">
                <i class="fas fa-target"></i>
                {{ round($monthProgress, 1) }}% meta mensual
            </div>
        </div>

        <!-- Nuevos Clientes -->
        <div class="stat-card" style="--accent-color: #e83e8c">
            <div class="stat-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            @php
                $newCustomers = App\Models\User::where('usertype', 'customer')
                    ->whereDate('created_at', today())->count();
                $totalCustomers = App\Models\User::where('usertype', 'customer')->count();
            @endphp
            <div class="stat-number">{{ $newCustomers }}</div>
            <div class="stat-label">Nuevos Hoy</div>
            <div class="stat-change change-positive">
                <i class="fas fa-users"></i>
                {{ number_format($totalCustomers) }} total
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Alertas y Notificaciones -->
        <div class="col-md-6 col-lg-4">
            <div class="section-container">
                <div class="section-header">
                    <h5 class="section-title">
                        <i class="fas fa-bell text-warning"></i>Alertas Importantes
                    </h5>
                </div>

                <!-- Stock Crítico -->
                @php
                    $criticalStock = App\Models\Stockweb::where('qty', '<=', 5)->take(3)->get();
                @endphp
                @foreach($criticalStock as $item)
                <div class="alert-item alert-critical">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                    <div>
                        <div class="fw-bold">Stock crítico</div>
                        <small>{{ $item->product }}: {{ $item->qty }} unidades</small>
                    </div>
                </div>
                @endforeach

                <!-- Pedidos Pendientes -->
                @if($newOrders > 10)
                <div class="alert-item">
                    <i class="fas fa-clock text-warning"></i>
                    <div>
                        <div class="fw-bold">Alta demanda</div>
                        <small>{{ $newOrders }} pedidos esperando procesamiento</small>
                    </div>
                </div>
                @endif

                <!-- Sistema de Envío -->
                <div class="alert-item alert-success">
                    <i class="fas fa-shipping-fast text-success"></i>
                    <div>
                        <div class="fw-bold">Envío gratis activo</div>
                        <small>Sistema funcionando correctamente</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Inventario -->
        <div class="col-md-6 col-lg-4">
            <div class="section-container">
                <div class="section-header">
                    <h5 class="section-title">
                        <i class="fas fa-boxes text-primary"></i>Estado del Inventario
                    </h5>
                    <a href="{{ URL::to('stock') }}" class="btn btn-sm btn-outline-primary">Ver Todo</a>
                </div>

                @php
                    $stockHigh = App\Models\Stockweb::where('qty', '>', 10)->count();
                    $stockMedium = App\Models\Stockweb::where('qty', '<=', 10)->where('qty', '>', 5)->count();
                    $stockLow = App\Models\Stockweb::where('qty', '<=', 5)->where('qty', '>', 0)->count();
                    $stockEmpty = App\Models\Stockweb::where('qty', '<=', 0)->count();
                    $totalStock = App\Models\Stockweb::count();
                @endphp

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-success fw-bold">Stock Alto</span>
                        <span>{{ $stockHigh }}</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill bg-success" style="width: {{ $totalStock > 0 ? ($stockHigh / $totalStock) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-warning fw-bold">Stock Medio</span>
                        <span>{{ $stockMedium }}</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill bg-warning" style="width: {{ $totalStock > 0 ? ($stockMedium / $totalStock) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-danger fw-bold">Stock Bajo</span>
                        <span>{{ $stockLow }}</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill bg-danger" style="width: {{ $totalStock > 0 ? ($stockLow / $totalStock) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <small class="text-muted">{{ $totalStock }} productos en inventario</small>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="col-md-12 col-lg-4">
            <div class="section-container">
                <div class="section-header">
                    <h5 class="section-title">
                        <i class="fas fa-bolt text-warning"></i>Acciones Rápidas
                    </h5>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ URL::to('customers') }}" class="btn btn-outline-primary btn-action">
                        <i class="fas fa-shopping-cart me-2"></i>Ver Pedidos
                    </a>
                    <a href="{{ URL::to('newstock') }}" class="btn btn-outline-success btn-action">
                        <i class="fas fa-plus me-2"></i>Agregar Stock
                    </a>
                    <a href="{{ URL::to('slots') }}" class="btn btn-outline-info btn-action">
                        <i class="fas fa-clock me-2"></i>Horarios
                    </a>
                    <a href="{{ URL::to('modules') }}" class="btn btn-outline-warning btn-action">
                        <i class="fas fa-tags me-2"></i>Categorías
                    </a>
                    <a href="{{ URL::to('financing') }}" class="btn btn-outline-secondary btn-action">
                        <i class="fas fa-shipping-fast me-2"></i>Config. Envíos
                    </a>
                </div>

                <!-- Mini gráfico de ventas semanales -->
                <div class="mt-4">
                    <h6 class="text-muted mb-2">Ventas esta semana</h6>
                    <div class="mini-chart">
                        @for($i = 6; $i >= 0; $i--)
                            @php
                                $date = now()->subDays($i);
                                $daySales = App\Models\Order::whereDate('created_at', $date)->count();
                                $maxHeight = 40; // altura máxima en px
                                $height = $daySales > 0 ? min(($daySales / 10) * $maxHeight, $maxHeight) : 2;
                            @endphp
                            <div class="chart-bar" style="height: {{ $height }}px" title="{{ $date->format('d/m') }}: {{ $daySales }} pedidos"></div>
                        @endfor
                    </div>
                    <small class="text-muted">Últimos 7 días</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo de la empresa -->
    <div class="section-container text-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-width: 300px; opacity: 0.8;" />
        <div class="mt-3">
            <small class="text-muted">Sistema de gestión integral - Actualizado en tiempo real</small>
        </div>
    </div>
</div>

<!-- JavaScript para funcionalidad del dashboard -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para toggle OTP
    window.toggleOTP = function() {
        const status = document.getElementById('otp-status');
        const currentStatus = status.textContent;
        
        // Simular cambio de estado (aquí harías una llamada AJAX real)
        if (currentStatus === 'Activo') {
            status.textContent = 'Inactivo';
            status.className = 'badge bg-danger';
        } else {
            status.textContent = 'Activo';
            status.className = 'badge bg-success';
        }
    };

    // Inicializar estado OTP
    document.getElementById('otp-status').textContent = 'Activo';
    document.getElementById('otp-status').className = 'badge bg-success';

    // Actualizar hora cada minuto
    setInterval(() => {
        const now = new Date();
        const timeElements = document.querySelectorAll('.current-time');
        timeElements.forEach(el => {
            el.textContent = now.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'});
        });
    }, 60000);

    // Animación de entrada para las cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Tooltip para las barras del mini gráfico
    const chartBars = document.querySelectorAll('.chart-bar');
    chartBars.forEach(bar => {
        bar.addEventListener('mouseenter', function() {
            this.style.opacity = '1';
            this.style.transform = 'scale(1.1)';
        });
        
        bar.addEventListener('mouseleave', function() {
            this.style.opacity = '0.7';
            this.style.transform = 'scale(1)';
        });
    });
});
</script>

@endsection
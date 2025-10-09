@extends('layouts.app')
@section('section')

<!-- Estilos del Dashboard Ejecutivo -->
<style>
.executive-header {
    background: white;
    color: #495057;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

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
    width: 3px;
    height: 100%;
    background: #dee2e6;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #6c757d;
    margin-bottom: 1rem;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #495057;
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
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    display: flex;
    align-items: end;
    padding: 0.5rem;
    gap: 2px;
}

.chart-bar {
    background: #6c757d;
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
    <!-- Header Ejecutivo -->
    <div class="executive-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">CONTROL EJECUTIVO</h1>
                <p class="mb-0 opacity-75">Monitoreo en tiempo real del sistema de delivery y operaciones críticas</p>
            </div>
            <div class="col-md-4 text-md-end">
                @php
                    $systemHealth = 'OPERATIVO';
                    $criticalOrders = App\Models\Order::where('status', 'open')->where('created_at', '<', now()->subHours(2))->count();
                    $stockCritical = App\Models\Stockweb::where('qty', '<=', 3)->count();
                    $driversActive = App\Models\Order::where('status', 'On the Way')->count();

                    if ($criticalOrders > 5 || $stockCritical > 10 || $driversActive < 2) {
                        $systemHealth = 'ALERTA';
                    }
                @endphp
                <div class="text-end">
                    <div class="h4 mb-1">{{ now()->format('H:i') }}</div>
                    {{-- <div class="badge {{ $systemHealth === 'OPERATIVO' ? 'bg-success' : 'bg-warning' }} px-3 py-1">
                        🔥 {{ $systemHealth }}
                    </div> --}}
                    <small class="d-block mt-1">{{ now()->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- ALERTAS CRÍTICAS DEL NEGOCIO -->
    @php
        $criticalAlerts = [];

        // Variables necesarias para las alertas
        $ordersInQueue = App\Models\Order::where('status', 'open')->count();

        // Pedidos atrasados (más de 2 horas sin procesar)
        $delayedOrders = App\Models\Order::where('status', 'open')
            ->where('created_at', '<', now()->subHours(2))->count();
        if ($delayedOrders > 0) {
            $criticalAlerts[] = [
                'type' => 'danger',
                'icon' => 'fas fa-clock',
                'title' => 'PEDIDOS ATRASADOS',
                'message' => $delayedOrders . ' pedidos llevan +2hrs sin procesar',
                'action' => 'allcustomers',
                'priority' => 'CRÍTICO'
            ];
        }

        // Stock agotado con ventas recientes
        $hotProducts = App\Models\Ordedetail::select('item_name')
            ->whereHas('order', function($q) {
                $q->where('created_at', '>=', now()->subDays(3));
            })
            ->groupBy('item_name')
            ->havingRaw('SUM(item_qty) > 10')
            ->pluck('item_name');

        $outOfStockHot = App\Models\Stockweb::whereIn('product', $hotProducts)
            ->where('qty', '<=', 0)->count();

        if ($outOfStockHot > 0) {
            $criticalAlerts[] = [
                'type' => 'danger',
                'icon' => 'fas fa-fire',
                'title' => 'PRODUCTOS CALIENTES SIN STOCK',
                'message' => $outOfStockHot . ' productos populares están agotados',
                'action' => 'stock',
                'priority' => 'URGENTE'
            ];
        }

        // Capacidad de drivers vs demanda
        $pendingDeliveries = App\Models\Order::where('status', 'open')
            ->whereNotNull('delivery_date')->count();
        $activeDrivers = App\Models\Order::where('status', 'On the Way')
            ->distinct('dman')->count('dman');
        $totalDrivers = App\Models\User::where('usertype', 'driver')
            ->where('is_active', 'active')->count();

        if ($pendingDeliveries > ($totalDrivers * 2)) {
            $criticalAlerts[] = [
                'type' => 'warning',
                'icon' => 'fas fa-truck',
                'title' => 'CAPACIDAD DE ENTREGA SATURADA',
                'message' => $pendingDeliveries . ' entregas vs ' . $totalDrivers . ' drivers disponibles',
                'action' => 'allcustomers',
                'priority' => 'ALTO'
            ];
        }

        // Pagos fallidos recientes
        $failedPayments = App\Models\Order::where('payment_status', 'failed')
            ->where('created_at', '>=', now()->subHours(24))->count();

        if ($failedPayments > 0) {
            $criticalAlerts[] = [
                'type' => 'warning',
                'icon' => 'fas fa-credit-card',
                'title' => 'PAGOS FALLIDOS',
                'message' => $failedPayments . ' pagos fallaron en las últimas 24h',
                'action' => 'allcustomers',
                'priority' => 'MEDIO'
            ];
        }

        // Mensajes de feedback recientes (todos los feedback como alerta)
        $recentFeedback = App\Models\Customerfeedback::where('created_at', '>=', now()->subDays(1))->count();

        if ($recentFeedback > 3) {
            $criticalAlerts[] = [
                'type' => 'info',
                'icon' => 'fas fa-comments',
                'title' => 'FEEDBACK DE CLIENTES',
                'message' => $recentFeedback . ' mensajes de clientes hoy - revisar',
                'action' => 'allcustomers',
                'priority' => 'REVISAR'
            ];
        }
    @endphp

    @if(count($criticalAlerts) > 0)
    <div class="section-container mb-4">
        <div class="row">
            @foreach($criticalAlerts as $alert)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="p-3 border rounded shadow-sm" style="background: {{ $alert['type'] == 'danger' ? '#f8f9fa' : ($alert['type'] == 'warning' ? '#f8f9fa' : '#f8f9fa') }}; border-color: {{ $alert['type'] == 'danger' ? '#dc3545' : ($alert['type'] == 'warning' ? '#fd7e14' : '#1976d2') }}!important; border-left: 4px solid {{ $alert['type'] == 'danger' ? '#dc3545' : ($alert['type'] == 'warning' ? '#fd7e14' : '#1976d2') }};">
                    <div class="d-flex align-items-center">
                        <i class="{{ $alert['icon'] }} fa-2x me-3" style="color: {{ $alert['type'] == 'danger' ? '#dc3545' : ($alert['type'] == 'warning' ? '#fd7e14' : '#1976d2') }}; opacity: 0.8;"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold small" style="color: #495057;">{{ $alert['title'] }}</div>
                            <div class="small" style="color: #6c757d;">{{ $alert['message'] }}</div>
                            <div class="mt-2">
                                <span class="badge" style="background: {{ $alert['type'] == 'danger' ? '#dc3545' : ($alert['type'] == 'warning' ? '#fd7e14' : '#1976d2') }}; color: white; font-size: 0.75rem;">{{ $alert['priority'] }}</span>
                                <a href="{{ URL::to($alert['action']) }}" class="btn btn-sm ms-2" style="border: 1px solid {{ $alert['type'] == 'danger' ? '#dc3545' : ($alert['type'] == 'warning' ? '#fd7e14' : '#1976d2') }}; color: {{ $alert['type'] == 'danger' ? '#dc3545' : ($alert['type'] == 'warning' ? '#fd7e14' : '#1976d2') }}; background: white; font-size: 0.8rem;">Revisar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Métricas Principales -->
    <div class="stats-grid">
        <!-- PEDIDOS EN COLA -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-fire"></i>
            </div>
            @php
                $ordersInQueue = App\Models\Order::where('status', 'open')->count();
                $ordersToday = App\Models\Order::whereDate('created_at', today())->count();
                $avgProcessingTime = App\Models\Order::where('status', 'Delivered')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time')
                    ->first()->avg_time ?? 60;
                $urgentOrders = App\Models\Order::where('status', 'open')
                    ->where('created_at', '<', now()->subHours(1))->count();
            @endphp
            <div class="stat-number">{{ $ordersInQueue }}</div>
            <div class="stat-label">Cola de Pedidos</div>
            <div class="stat-change {{ $urgentOrders > 5 ? 'change-negative' : 'change-positive' }}">
                <i class="fas fa-clock"></i>
                {{ round($avgProcessingTime) }}min promedio
            </div>
        </div>

        <!-- DRIVERS EN ACCIÓN -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-route"></i>
            </div>
            @php
                $driversInRoute = App\Models\Order::where('status', 'On the Way')
                    ->distinct('dman')->count('dman');
                $totalActiveDrivers = App\Models\User::where('usertype', 'driver')
                    ->where('is_active', 'active')->count();
                $deliveredToday = App\Models\Order::where('status', 'Delivered')
                    ->whereDate('updated_at', today())->count();
                $utilizationRate = $totalActiveDrivers > 0 ? ($driversInRoute / $totalActiveDrivers) * 100 : 0;
            @endphp
            <div class="stat-number">{{ $driversInRoute }}/{{ $totalActiveDrivers }}</div>
            <div class="stat-label">Drivers Activos</div>
            <div class="stat-change {{ $utilizationRate > 80 ? 'change-negative' : 'change-positive' }}">
                <i class="fas fa-truck-fast"></i>
                {{ $deliveredToday }} entregas hoy
            </div>
        </div>

        <!-- STOCK CRÍTICO -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-warehouse"></i>
            </div>
            @php
                $criticalStock = App\Models\Stockweb::where('qty', '<=', 5)->count();
                $zeroStock = App\Models\Stockweb::where('qty', '<=', 0)->count();
                $totalProducts = App\Models\Stockweb::count();
                $stockHealth = $totalProducts > 0 ? (($totalProducts - $criticalStock) / $totalProducts) * 100 : 100;

                // Productos con alta rotación en stock crítico
                $hotProductsLowStock = App\Models\Stockweb::where('qty', '<=', 5)
                    ->whereIn('product', function($query) {
                        $query->select('item_name')
                            ->from('ordedetails')
                            ->join('orders', 'ordedetails.orderno', '=', 'orders.orderno')
                            ->where('orders.created_at', '>=', now()->subDays(3))
                            ->groupBy('item_name')
                            ->havingRaw('SUM(item_qty) > 5');
                    })->count();
            @endphp
            <div class="stat-number">{{ $criticalStock }}</div>
            <div class="stat-label">Stock Crítico</div>
            <div class="stat-change {{ $hotProductsLowStock > 0 ? 'change-negative' : 'change-neutral' }}">
                <i class="fas fa-fire"></i>
                {{ $hotProductsLowStock }} populares afectados
            </div>
        </div>

        <!-- REVENUE REAL-TIME -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            @php
                $todayRevenue = App\Models\Order::where('payment_status', 'paid')
                    ->whereDate('created_at', today())->sum('total_amount');
                $yesterdayRevenue = App\Models\Order::where('payment_status', 'paid')
                    ->whereDate('created_at', now()->subDay())->sum('total_amount');
                $revenueChange = $yesterdayRevenue > 0 ? (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100 : 0;

                // Meta diaria basada en promedio mensual
                $monthlyTotal = App\Models\Order::where('payment_status', 'paid')
                    ->where('created_at', '>=', now()->startOfMonth())
                    ->sum('total_amount');
                $monthlyAvg = now()->day > 0 ? $monthlyTotal / now()->day : 0;
                $targetProgress = $monthlyAvg > 0 ? ($todayRevenue / $monthlyAvg) * 100 : 0;
            @endphp
            <div class="stat-number">${{ number_format($todayRevenue/1000, 1) }}K</div>
            <div class="stat-label">Revenue Hoy</div>
            <div class="stat-change {{ $revenueChange >= 0 ? 'change-positive' : 'change-negative' }}">
                <i class="fas fa-{{ $revenueChange >= 0 ? 'trending-up' : 'trending-down' }}"></i>
                {{ round($targetProgress, 0) }}% vs promedio
            </div>
        </div>

        <!-- CUSTOMER EXPERIENCE -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-smile"></i>
            </div>
            @php
                $totalFeedback = App\Models\Customerfeedback::where('created_at', '>=', now()->subDays(7))->count();
                $recentFeedback = App\Models\Customerfeedback::where('created_at', '>=', now()->subDays(1))->count();
                // Calculamos tasa de respuesta (feedback vs órdenes)
                $ordersWeek = App\Models\Order::where('created_at', '>=', now()->subDays(7))->count();
                $responseRate = $ordersWeek > 0 ? ($totalFeedback / $ordersWeek) * 100 : 0;
            @endphp
            <div class="stat-number">{{ $totalFeedback }}</div>
            <div class="stat-label">Feedback Semanal</div>
            <div class="stat-change {{ $responseRate >= 20 ? 'change-positive' : 'change-neutral' }}">
                <i class="fas fa-comments"></i>
                {{ round($responseRate, 0) }}% tasa respuesta
            </div>
        </div>

        <!-- EFICIENCIA OPERATIVA -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            @php
                $ordersToday = App\Models\Order::whereDate('created_at', today())->count();
                $deliveredToday = App\Models\Order::where('status', 'Delivered')
                    ->whereDate('updated_at', today())->count();
                $deliveryEfficiency = $ordersToday > 0 ? ($deliveredToday / $ordersToday) * 100 : 0;

                // Tiempo promedio de entrega
                $avgDeliveryTime = App\Models\Order::where('status', 'Delivered')
                    ->whereDate('updated_at', today())
                    ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time')
                    ->first()->avg_time ?? 0;
            @endphp
            <div class="stat-number">{{ round($deliveryEfficiency, 0) }}%</div>
            <div class="stat-label">Eficiencia</div>
            <div class="stat-change {{ $deliveryEfficiency >= 80 ? 'change-positive' : 'change-negative' }}">
                <i class="fas fa-stopwatch"></i>
                {{ round($avgDeliveryTime, 0) }}min promedio
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Estado de Pagos -->
        <div class="col-md-6 col-lg-4">
            <div class="section-container">
                <div class="section-header">
                    <h5 class="section-title">
                        <i class="fas fa-credit-card text-success"></i>Estado de Pagos Hoy
                    </h5>
                    <a href="{{ URL::to('allcustomers') }}" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                </div>

                @php
                    // Estadísticas de pagos del día actual
                    $paymentsToday = [
                        'paid' => App\Models\Order::where('payment_status', 'paid')->whereDate('created_at', today())->count(),
                        'failed' => App\Models\Order::where('payment_status', 'failed')->whereDate('created_at', today())->count(),
                        'pending' => App\Models\Order::where('payment_status', 'pending')->whereDate('created_at', today())->count(),
                        'cancelled' => App\Models\Order::where('payment_status', 'cancelled')->whereDate('created_at', today())->count(),
                    ];

                    // Montos de pagos usando total_amount que sí existe
                    $paymentAmounts = [
                        'paid_amount' => App\Models\Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_amount'),
                        'failed_amount' => App\Models\Order::where('payment_status', 'failed')->whereDate('created_at', today())->sum('total_amount'),
                        'pending_amount' => App\Models\Order::where('payment_status', 'pending')->whereDate('created_at', today())->sum('total_amount'),
                    ];

                    $totalPayments = array_sum($paymentsToday);
                    $totalAmount = $paymentAmounts['paid_amount'] + $paymentAmounts['pending_amount'];
                    $successRate = $totalPayments > 0 ? ($paymentsToday['paid'] / $totalPayments) * 100 : 0;
                @endphp

                <!-- Resumen rápido -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="p-2 border rounded text-center" style="background: #f8f9fa; border-color: #28a745!important;">
                            <div class="h4 mb-0" style="color: #28a745;">{{ $paymentsToday['paid'] }}</div>
                            <small style="color: #495057;">Completados</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded text-center" style="background: #f8f9fa; border-color: {{ $paymentsToday['failed'] > 5 ? '#dc3545' : '#dee2e6' }}!important;">
                            <div class="h4 mb-0" style="color: {{ $paymentsToday['failed'] > 5 ? '#dc3545' : '#495057' }};">{{ $paymentsToday['failed'] }}</div>
                            <small style="color: #495057;">Fallidos</small>
                        </div>
                    </div>
                </div>

                <!-- Desglose detallado -->
                <div class="mb-2 d-flex justify-content-between align-items-center p-2 border rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                        <span class="small fw-bold" style="color: #495057;">Pagados</span>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold" style="color: #28a745;">${{ number_format($paymentAmounts['paid_amount'], 0) }}</div>
                        <small class="text-muted">{{ $paymentsToday['paid'] }} pagos</small>
                    </div>
                </div>

                <div class="mb-2 d-flex justify-content-between align-items-center p-2 border rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2" style="color: #fd7e14;"></i>
                        <span class="small fw-bold" style="color: #495057;">Pendientes</span>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold" style="color: #fd7e14;">${{ number_format($paymentAmounts['pending_amount'], 0) }}</div>
                        <small class="text-muted">{{ $paymentsToday['pending'] }} pagos</small>
                    </div>
                </div>

                @if($paymentsToday['failed'] > 0)
                <div class="mb-2 d-flex justify-content-between align-items-center p-2 border rounded" style="background: #f8f9fa;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times-circle me-2" style="color: #dc3545;"></i>
                        <span class="small fw-bold" style="color: #495057;">Fallidos</span>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold" style="color: #dc3545;">${{ number_format($paymentAmounts['failed_amount'], 0) }}</div>
                        <small class="text-muted">{{ $paymentsToday['failed'] }} pagos</small>
                    </div>
                </div>
                @endif

                @if($paymentsToday['cancelled'] > 0)
                <div class="mb-2 d-flex justify-content-between align-items-center p-2 border rounded" style="background: #f8f9fa;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-ban me-2" style="color: #6c757d;"></i>
                        <span class="small fw-bold" style="color: #495057;">Cancelados</span>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold" style="color: #6c757d;">{{ $paymentsToday['cancelled'] }}</div>
                        <small class="text-muted">pedidos</small>
                    </div>
                </div>
                @endif

                <!-- Tasa de éxito -->
                <div class="mt-3 p-2 border rounded text-center" style="background: {{ $successRate >= 80 ? '#d4edda' : ($successRate >= 60 ? '#fff3cd' : '#f8d7da') }}; border-color: {{ $successRate >= 80 ? '#28a745' : ($successRate >= 60 ? '#fd7e14' : '#dc3545') }}!important;">
                    <div class="small" style="color: #495057;">Tasa de Éxito</div>
                    <div class="h4 mb-0" style="color: {{ $successRate >= 80 ? '#28a745' : ($successRate >= 60 ? '#fd7e14' : '#dc3545') }};">{{ number_format($successRate, 1) }}%</div>
                </div>

                @if($paymentsToday['failed'] > 3)
                <div class="mt-2 text-center">
                    <a href="{{ URL::to('allcustomers') }}" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-exclamation-triangle me-1"></i>Revisar Fallidos
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- PRODUCTOS MÁS VENDIDOS EN RIESGO -->
        <div class="col-md-6 col-lg-4">
            <div class="section-container">
                <div class="section-header">
                    <h5 class="section-title">
                        <i class="fas fa-fire text-danger"></i>Productos Calientes en Riesgo
                    </h5>
                    <a href="{{ URL::to('stock') }}" class="btn btn-sm btn-outline-danger">Reabastecer</a>
                </div>

                @php
                    // Productos más vendidos en los últimos 7 días
                    $topProducts = App\Models\Ordedetail::join('orders', 'ordedetails.orderno', '=', 'orders.orderno')
                        ->where('orders.created_at', '>=', now()->subDays(7))
                        ->select('item_name')
                        ->selectRaw('SUM(item_qty) as total_sold')
                        ->groupBy('item_name')
                        ->orderBy('total_sold', 'desc')
                        ->limit(5)
                        ->get();
                @endphp

                @foreach($topProducts as $product)
                    @php
                        $stockInfo = App\Models\Stockweb::where('product', $product->item_name)->first();
                        $currentStock = $stockInfo ? $stockInfo->qty : 0;
                        $daysLeft = $product->total_sold > 0 ? ($currentStock / ($product->total_sold / 7)) : 999;

                        $riskLevel = 'success';
                        $riskText = 'OK';
                        if ($daysLeft < 1) {
                            $riskLevel = 'danger';
                            $riskText = 'CRÍTICO';
                        } elseif ($daysLeft < 3) {
                            $riskLevel = 'warning';
                            $riskText = 'RIESGO';
                        }
                    @endphp
                    <div class="mb-3 p-2 border rounded" style="background: #f8f9fa;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold small" style="color: #495057;">{{ $product->item_name }}</div>
                                <small class="text-muted">{{ $product->total_sold }} vendidos/semana</small>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold" style="color: {{ $riskLevel == 'danger' ? '#dc3545' : ($riskLevel == 'warning' ? '#fd7e14' : '#28a745') }};">{{ $currentStock }} unidades</div>
                                <small class="badge" style="background: {{ $riskLevel == 'danger' ? '#f8d7da' : ($riskLevel == 'warning' ? '#fff3cd' : '#d4edda') }}; color: {{ $riskLevel == 'danger' ? '#dc3545' : ($riskLevel == 'warning' ? '#fd7e14' : '#28a745') }}; border: 1px solid {{ $riskLevel == 'danger' ? '#dc3545' : ($riskLevel == 'warning' ? '#fd7e14' : '#28a745') }};">{{ $riskText }}</small>
                            </div>
                        </div>
                        @if($daysLeft < 999)
                            <small class="d-block mt-1" style="color: #6c757d;">⚡ {{ number_format($daysLeft, 1) }} días restantes</small>
                        @endif
                    </div>
                @endforeach

                @if($topProducts->count() == 0)
                    <p class="text-muted text-center">No hay datos de ventas suficientes</p>
                @endif
            </div>
        </div>

        <!-- CENTRO DE COMANDO OPERATIVO -->
        <div class="col-md-12 col-lg-4">
            <div class="section-container">
                <div class="section-header">
                    <h5 class="section-title">
                        <i class="fas fa-crosshairs text-danger"></i>Centro de Comando
                    </h5>
                </div>

                @php
                    // Métricas operativas críticas en tiempo real
                    $urgentOrders = App\Models\Order::where('status', 'open')
                        ->where('created_at', '<', now()->subHours(1))->count();
                    $driversInRoute = App\Models\Order::where('status', 'On the Way')
                        ->distinct('dman')->count();
                    $failedPayments = App\Models\Order::where('payment_status', 'failed')
                        ->whereDate('created_at', today())->count();
                    $avgOrderValue = App\Models\Order::where('payment_status', 'paid')
                        ->whereDate('created_at', today())->avg('total_amount') ?? 0;
                    $totalRevenue = App\Models\Order::where('payment_status', 'paid')
                        ->whereDate('created_at', today())->sum('total_amount');
                @endphp

                <!-- Métricas críticas -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="p-2 border rounded text-center" style="background: {{ $urgentOrders > 5 ? '#f8d7da' : '#f8f9fa' }}; border-color: {{ $urgentOrders > 5 ? '#dc3545' : '#dee2e6' }}!important;">
                            <div class="h4 mb-0" style="color: {{ $urgentOrders > 5 ? '#dc3545' : '#495057' }};">{{ $urgentOrders }}</div>
                            <small style="color: #6c757d;">Pedidos +1h</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded text-center" style="background: {{ $driversInRoute < 2 ? '#fff3cd' : '#f8f9fa' }}; border-color: {{ $driversInRoute < 2 ? '#fd7e14' : '#dee2e6' }}!important;">
                            <div class="h4 mb-0" style="color: {{ $driversInRoute < 2 ? '#fd7e14' : '#495057' }};">{{ $driversInRoute }}</div>
                            <small style="color: #6c757d;">Drivers activos</small>
                        </div>
                    </div>
                </div>

                <!-- Revenue hoy -->
                <div class="mb-3 p-3 border rounded text-center" style="background: #e3f2fd; border-color: #1976d2!important;">
                    <div class="h3 mb-1" style="color: #1976d2;">${{ number_format($totalRevenue, 0) }}</div>
                    <div class="small" style="color: #495057;">Revenue hoy | Promedio: ${{ number_format($avgOrderValue, 0) }}</div>
                </div>

                <!-- Acciones URGENTES -->
                <div class="d-grid gap-2">
                    @if($urgentOrders > 0)
                    <a href="{{ URL::to('allcustomers') }}" class="btn btn-action" style="background: #dc3545; color: white; border: 1px solid #dc3545;">
                        <i class="fas fa-fire me-2"></i>PROCESAR PEDIDOS ({{ $urgentOrders }})
                    </a>
                    @endif

                    @if($failedPayments > 0)
                    <a href="{{ URL::to('allcustomers') }}" class="btn btn-action" style="background: #fd7e14; color: white; border: 1px solid #fd7e14;">
                        <i class="fas fa-credit-card me-2"></i>PAGOS FALLIDOS ({{ $failedPayments }})
                    </a>
                    @endif

                    <a href="{{ URL::to('newstock') }}" class="btn btn-action" style="background: #28a745; color: white; border: 1px solid #28a745;">
                        <i class="fas fa-plus me-2"></i>Agregar Stock
                    </a>

                    <a href="{{ URL::to('allcustomers') }}" class="btn btn-action" style="background: #6c757d; color: white; border: 1px solid #6c757d;">
                        <i class="fas fa-truck me-2"></i>Asignar Drivers
                    </a>
                </div>

                <!-- Revenue trend mini -->
                <div class="mt-3 text-center">
                    <small class="text-muted">Trend 7d</small>
                    <div class="mini-chart">
                        @php
                            // Obtener datos de los últimos 7 días de una vez
                            $weeklyData = [];
                            $maxWeekRevenue = 1; // Evitar división por 0
                            for($i = 6; $i >= 0; $i--) {
                                $date = now()->subDays($i);
                                $dayRevenue = App\Models\Order::where('payment_status', 'paid')
                                    ->whereDate('created_at', $date)->sum('total_amount');
                                $weeklyData[] = ['date' => $date, 'revenue' => $dayRevenue];
                                $maxWeekRevenue = max($maxWeekRevenue, $dayRevenue);
                            }
                        @endphp
                        @foreach($weeklyData as $dayData)
                            @php
                                $maxHeight = 30;
                                $height = $dayData['revenue'] > 0 ? min(($dayData['revenue'] / $maxWeekRevenue) * $maxHeight, $maxHeight) : 2;
                            @endphp
                            <div class="chart-bar" style="height: {{ $height }}px" title="{{ $dayData['date']->format('d/m') }}: ${{ number_format($dayData['revenue'], 0) }}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ANÁLISIS DE PERFORMANCE DEL NEGOCIO -->
    <div class="section-container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-chart-line text-success me-2"></i>Performance Hoy vs Ayer</h5>
                @php
                    $todayOrders = App\Models\Order::whereDate('created_at', today())->count();
                    $yesterdayOrders = App\Models\Order::whereDate('created_at', now()->subDay())->count();
                    $orderGrowth = $yesterdayOrders > 0 ? (($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100 : 0;

                    $todayRevenue = App\Models\Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_amount');
                    $yesterdayRevenue = App\Models\Order::where('payment_status', 'paid')->whereDate('created_at', now()->subDay())->sum('total_amount');
                    $revenueGrowth = $yesterdayRevenue > 0 ? (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100 : 0;
                @endphp
                <div class="row">
                    <div class="col-6">
                        <div class="p-2 border rounded text-center">
                            <div class="h5 mb-1 text-{{ $orderGrowth >= 0 ? 'success' : 'danger' }}">
                                {{ $orderGrowth >= 0 ? '+' : '' }}{{ number_format($orderGrowth, 1) }}%
                            </div>
                            <small class="text-muted">Pedidos</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded text-center">
                            <div class="h5 mb-1 text-{{ $revenueGrowth >= 0 ? 'success' : 'danger' }}">
                                {{ $revenueGrowth >= 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}%
                            </div>
                            <small class="text-muted">Revenue</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5><i class="fas fa-clock text-warning me-2"></i>Tiempos Críticos</h5>
                @php
                    $avgProcessTime = App\Models\Order::where('status', 'Delivered')
                        ->where('created_at', '>=', now()->subDays(7))
                        ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time')
                        ->first()->avg_time ?? 0;
                    $oldestOpenOrder = App\Models\Order::where('status', 'open')
                        ->orderBy('created_at', 'asc')->first();
                    $oldestWaitTime = $oldestOpenOrder ? now()->diffInMinutes($oldestOpenOrder->created_at) : 0;
                @endphp
                <div class="row">
                    <div class="col-6">
                        <div class="p-2 border rounded text-center">
                            <div class="h5 mb-1 text-{{ $avgProcessTime > 120 ? 'danger' : 'success' }}">
                                {{ number_format($avgProcessTime, 0) }}min
                            </div>
                            <small class="text-muted">Tiempo promedio</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded text-center">
                            <div class="h5 mb-1 text-{{ $oldestWaitTime > 120 ? 'danger' : 'warning' }}">
                                {{ number_format($oldestWaitTime, 0) }}min
                            </div>
                            <small class="text-muted">Pedido más viejo</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para funcionalidad del dashboard -->
<script>
document.addEventListener('DOMContentLoaded', function() {
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

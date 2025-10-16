<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('send:task-reminders')->everyFiveMinutes();
		$schedule->command('app:fetch-email')->everyMinute();
		$schedule->command('transcriptions:poll')->everyFiveMinutes();

		// 🗑️ CLEANUP AUTOMÁTICO: Limpiar órdenes temporales cada 30 minutos
		$schedule->call(function () {
			try {
				$controller = new \App\Http\Controllers\ControllsController();
				$response = $controller->cleanupTempOrders();
				\Log::info('🧹 Cleanup automático ejecutado', ['response' => $response->getData()]);
			} catch (\Exception $e) {
				\Log::error('❌ Error en cleanup automático: ' . $e->getMessage());
			}
		})->everyThirtyMinutes()->name('cleanup-temp-orders');

		// 📸 INSTAGRAM SYNC: Sincronizar publicaciones de Instagram cada 24 horas
		$schedule->command('instagram:sync')
			->dailyAt('06:00') // Se ejecuta a las 6:00 AM
			->onSuccess(function () {
				\Log::info('✅ Instagram sync completado exitosamente');
			})
			->onFailure(function () {
				\Log::error('❌ Instagram sync falló');
			});

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

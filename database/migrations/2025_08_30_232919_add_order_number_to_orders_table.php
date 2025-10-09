<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Primero agregar la columna nullable
            $table->string('order_number', 13)->nullable()->after('id')
                ->comment('Número de orden en formato AA-MM-DD-HH-MM-SS para consistencia con frontend');
        });

        // Actualizar registros existentes con order_numbers basados en created_at
        $existingOrders = DB::table('orders')->whereNull('order_number')->get();
        
        foreach ($existingOrders as $order) {
            $createdAt = $order->created_at ? new \DateTime($order->created_at) : new \DateTime();
            $orderNumber = $this->generateOrderNumber($createdAt);
            
            // Asegurar unicidad agregando microsegundos si es necesario
            $counter = 0;
            $originalOrderNumber = $orderNumber;
            while (DB::table('orders')->where('order_number', $orderNumber)->exists()) {
                $counter++;
                $orderNumber = $originalOrderNumber . str_pad($counter, 2, '0', STR_PAD_LEFT);
            }
            
            DB::table('orders')->where('id', $order->id)->update(['order_number' => $orderNumber]);
        }

        // Ahora hacer la columna unique y NOT NULL
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number', 15)->unique()->nullable(false)->change();
            $table->index('order_number', 'idx_orders_order_number');
        });
    }

    private function generateOrderNumber(\DateTime $dateTime): string
    {
        $year = $dateTime->format('y'); // AA: últimos 2 dígitos del año
        $month = $dateTime->format('m'); // MM: mes con 0 inicial
        $day = $dateTime->format('d'); // DD: día con 0 inicial
        $hours = $dateTime->format('H'); // HH: horas con 0 inicial
        $minutes = $dateTime->format('i'); // MM: minutos con 0 inicial
        $seconds = $dateTime->format('s'); // SS: segundos con 0 inicial

        return "{$year}{$month}{$day}-{$hours}{$minutes}{$seconds}";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_order_number');
            $table->dropColumn('order_number');
        });
    }
};

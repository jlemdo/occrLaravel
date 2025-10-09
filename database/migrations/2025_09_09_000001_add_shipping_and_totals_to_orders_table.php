<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Agrega campos de shipping y totales a la tabla orders
     * para solucionar problemas de boucher y órdenes del frontend
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Campos de envío y totales
            $table->decimal('shipping_cost', 10, 2)->default(0.00)->after('discount_amount');
            $table->decimal('subtotal', 10, 2)->default(0.00)->after('shipping_cost');
            $table->decimal('total_amount', 10, 2)->default(0.00)->after('subtotal');
            
            // Índices para reportes y dashboard
            $table->index('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['total_amount']);
            $table->dropColumn(['shipping_cost', 'subtotal', 'total_amount']);
        });
    }
};
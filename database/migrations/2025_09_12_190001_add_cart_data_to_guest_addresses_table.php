<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guest_addresses', function (Blueprint $table) {
            // Campo para carrito persistente del guest
            if (!Schema::hasColumn('guest_addresses', 'cart_data')) {
                $table->json('cart_data')->nullable()->after('session_id')
                    ->comment('Carrito persistente del guest - JSON con productos y cantidades');
            }
            
            // Campo para timestamp de último acceso al carrito (para limpieza automática 24h)
            if (!Schema::hasColumn('guest_addresses', 'cart_updated_at')) {
                $table->timestamp('cart_updated_at')->nullable()->after('cart_data')
                    ->comment('Última vez que se actualizó el carrito - para limpieza automática');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_addresses', function (Blueprint $table) {
            if (Schema::hasColumn('guest_addresses', 'cart_data')) {
                $table->dropColumn('cart_data');
            }
            if (Schema::hasColumn('guest_addresses', 'cart_updated_at')) {
                $table->dropColumn('cart_updated_at');
            }
        });
    }
};
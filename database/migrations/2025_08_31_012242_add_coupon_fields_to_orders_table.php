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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('coupon_code')->nullable()->after('delivery_slot')->comment('Código del cupón aplicado');
            $table->decimal('coupon_discount', 10, 2)->nullable()->after('coupon_code')->comment('Valor del descuento del cupón');
            $table->enum('coupon_type', ['percentage', 'fixed'])->nullable()->after('coupon_discount')->comment('Tipo de descuento: percentage o fixed');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('coupon_type')->comment('Monto de descuento aplicado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['coupon_code', 'coupon_discount', 'coupon_type', 'discount_amount']);
        });
    }
};

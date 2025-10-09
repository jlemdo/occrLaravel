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
        Schema::table('proposalbatteries', function (Blueprint $table) {
            // Agregar campos básicos si no existen (estructura puede ser diferente entre entornos)
            if (!Schema::hasColumn('proposalbatteries', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'from')) {
                $table->date('from')->nullable();
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'to')) {
                $table->date('to')->nullable();
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'discount')) {
                $table->string('discount')->nullable();
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'type')) {
                $table->string('type')->nullable();
            }
            
            // Campos específicos para cupones - agregar al final sin referencias específicas
            if (!Schema::hasColumn('proposalbatteries', 'coupon_code')) {
                $table->string('coupon_code', 50)->nullable()->unique();
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'discount_type')) {
                $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'minimum_amount')) {
                $table->decimal('minimum_amount', 10, 2)->default(0);
            }
            
            if (!Schema::hasColumn('proposalbatteries', 'is_coupon')) {
                $table->boolean('is_coupon')->default(false)
                    ->comment('true = Cupón ecommerce (System 1), false = Descuento permanente (System 2)');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposalbatteries', function (Blueprint $table) {
            $table->dropColumn(['discount_type', 'coupon_code', 'minimum_amount', 'is_coupon']);
            // No eliminamos from/to porque pueden existir de antes
        });
    }
};

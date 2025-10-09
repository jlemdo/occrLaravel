<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Esta migración crea la tabla orders con SOLO los campos básicos originales.
     * Los campos adicionales (order_number, orderno, status_spanish, etc.) 
     * se agregan en migraciones posteriores que ya existen.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('userid')->nullable();
            $table->timestamps();
            $table->string('status', 200)->default('Open');
            $table->string('dman', 200)->nullable();
            $table->string('invoice')->nullable();
            $table->string('customer_lat')->nullable();
            $table->string('customer_long')->nullable();
            $table->string('user_email')->nullable();
            $table->string('need_invoice')->default('true');
            $table->string('tax_details')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('delivery_slot')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('amount_paid')->nullable();
            $table->string('payment_id')->nullable();
            
            // Índices básicos
            $table->index('userid');
            $table->index('user_email');
            $table->index('status');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
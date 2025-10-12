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
        Schema::create('phone_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 20)->index(); // Número de teléfono con código de país
            $table->string('otp', 6); // Código OTP de 6 dígitos
            $table->enum('type', ['signup', 'guest_checkout', 'profile_update', 'password_reset', 'guest_order'])->default('signup');
            $table->timestamp('expires_at')->index(); // Expiración del código
            $table->boolean('used')->default(false)->index(); // Si ya fue usado
            $table->string('user_agent')->nullable(); // User agent del cliente
            $table->ipAddress('ip_address')->nullable(); // IP del cliente
            $table->string('sns_message_id')->nullable(); // ID del mensaje SNS
            $table->timestamps();

            // Indexes compuestos para performance
            $table->index(['phone', 'type', 'used']);
            $table->index(['expires_at', 'used']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_verifications');
    }
};

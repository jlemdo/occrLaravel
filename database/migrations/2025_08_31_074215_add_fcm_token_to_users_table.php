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
        Schema::table('users', function (Blueprint $table) {
            // Campo para FCM token de dispositivos móviles
            if (!Schema::hasColumn('users', 'fcm_token')) {
                // Usar apple_id como referencia si existe, si no agregarlo al final
                if (Schema::hasColumn('users', 'apple_id')) {
                    $table->text('fcm_token')->nullable()->after('apple_id');
                } else {
                    $table->text('fcm_token')->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'fcm_token')) {
                $table->dropColumn('fcm_token');
            }
        });
    }
};

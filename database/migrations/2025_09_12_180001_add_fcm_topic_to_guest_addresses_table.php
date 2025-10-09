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
            // Campo para topic único de notificaciones por sesión de guest
            if (!Schema::hasColumn('guest_addresses', 'fcm_topic')) {
                $table->string('fcm_topic', 100)->nullable()->after('fcm_token')
                    ->comment('Topic único para notificaciones Firebase - evita mezcla entre guests');
            }
            
            // Campo para identificar sesión activa de guest
            if (!Schema::hasColumn('guest_addresses', 'session_id')) {
                $table->string('session_id', 50)->nullable()->after('fcm_topic')
                    ->comment('ID de sesión activa para evitar notificaciones cruzadas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_addresses', function (Blueprint $table) {
            if (Schema::hasColumn('guest_addresses', 'fcm_topic')) {
                $table->dropColumn('fcm_topic');
            }
            if (Schema::hasColumn('guest_addresses', 'session_id')) {
                $table->dropColumn('session_id');
            }
        });
    }
};
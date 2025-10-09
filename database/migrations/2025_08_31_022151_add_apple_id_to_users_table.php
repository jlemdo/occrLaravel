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
            // Solo agregar apple_id si no existe
            if (!Schema::hasColumn('users', 'apple_id')) {
                // Usar email como referencia si existe, si no agregarlo al final
                if (Schema::hasColumn('users', 'email')) {
                    $table->string('apple_id', 191)->nullable()->unique()->after('email');
                } else {
                    $table->string('apple_id', 191)->nullable()->unique();
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
            if (Schema::hasColumn('users', 'apple_id')) {
                $table->dropColumn('apple_id');
            }
        });
    }
};

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
            // Campo para ID de orden personalizado (formato: AA-MM-DD-HH-MM-SS)
            if (!Schema::hasColumn('orders', 'orderno')) {
                $table->string('orderno', 100)->nullable()->index()->after('id');
            }
            
            // Campo para estados en español directo desde backend
            if (!Schema::hasColumn('orders', 'status_spanish')) {
                $table->string('status_spanish', 100)->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'orderno')) {
                $table->dropColumn('orderno');
            }
            
            if (Schema::hasColumn('orders', 'status_spanish')) {
                $table->dropColumn('status_spanish');
            }
        });
    }
};

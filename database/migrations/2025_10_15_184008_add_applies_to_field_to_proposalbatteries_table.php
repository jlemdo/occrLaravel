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
            // Campo para indicar si el descuento aplica a envío o precio total
            // 'total' = precio total (por defecto), 'shipping' = solo envío
            $table->enum('applies_to', ['total', 'shipping'])->default('total')->after('discount_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposalbatteries', function (Blueprint $table) {
            $table->dropColumn('applies_to');
        });
    }
};

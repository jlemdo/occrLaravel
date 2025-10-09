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
        Schema::table('inverters', function (Blueprint $table) {
            // Agregar unit si no existe (campo básico que puede faltar en hosting)
            if (!Schema::hasColumn('inverters', 'unit')) {
                $table->string('unit', 200)->nullable();
            }
            
            // Agregar quantity solo si no existe
            if (!Schema::hasColumn('inverters', 'quantity')) {
                // Si unit existe, usarlo como referencia, si no, agregarlo al final
                if (Schema::hasColumn('inverters', 'unit')) {
                    $table->decimal('quantity', 8, 2)->nullable()->after('unit')
                        ->comment('Cantidad del producto (ej: 250 para 250gr, 2 para 2kg)');
                } else {
                    $table->decimal('quantity', 8, 2)->nullable()
                        ->comment('Cantidad del producto (ej: 250 para 250gr, 2 para 2kg)');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inverters', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};

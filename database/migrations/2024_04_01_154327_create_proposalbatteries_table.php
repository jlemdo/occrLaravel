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
        Schema::create('proposalbatteries', function (Blueprint $table) {
            $table->id();
			$table->string('capacity')->nullable();
			$table->string('power')->nullable();
			$table->string('system')->nullable();
			$table->string('text')->nullable();
			$table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposalbatteries');
    }
};

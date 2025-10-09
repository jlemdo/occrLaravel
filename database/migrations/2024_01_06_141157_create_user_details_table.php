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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('intro_video')->nullable();
            $table->text('qualification')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->text('languages')->nullable();
            $table->string('demonination')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('secondary_contact')->nullable();
            $table->text('address')->nullable();
            $table->string('audience_age_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};

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
            if (!Schema::hasColumn('proposalbatteries', 'coupon_code')) {
                $table->string('coupon_code', 50)->nullable()->unique();
            }
            if (!Schema::hasColumn('proposalbatteries', 'discount_type')) {
                $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            }
            if (!Schema::hasColumn('proposalbatteries', 'minimum_amount')) {
                $table->decimal('minimum_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('proposalbatteries', 'is_coupon')) {
                $table->boolean('is_coupon')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposalbatteries', function (Blueprint $table) {
            //
        });
    }
};

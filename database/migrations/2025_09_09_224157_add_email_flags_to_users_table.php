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
            // Flags para determinar si el usuario puede recibir emails
            $table->boolean('has_real_email')->default(true)->after('email')
                ->comment('True si el email es real/proxy de Apple, false si es generado internamente');
            
            $table->enum('email_type', ['real', 'proxy', 'generated'])->default('real')->after('has_real_email')
                ->comment('Tipo de email: real=normal, proxy=Apple relay, generated=fallback interno');
            
            $table->boolean('can_receive_emails')->default(true)->after('email_type')
                ->comment('True si podemos enviar emails a este usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['has_real_email', 'email_type', 'can_receive_emails']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DeliveryDay;
use App\Models\DeliveryTimeSlot;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabla para días de entrega permitidos
        Schema::create('delivery_days', function (Blueprint $table) {
            $table->id();
            $table->string('day_name'); // 'monday', 'tuesday', etc.
            $table->string('day_label'); // 'Lunes', 'Martes', etc.
            $table->integer('day_number'); // 1=Lunes, 2=Martes, 3=Miércoles, etc.
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0); // Para ordenar días
            $table->text('notes')->nullable(); // Notas del admin
            $table->timestamps();
        });

        // 2. Tabla para horarios de entrega disponibles
        Schema::create('delivery_time_slots', function (Blueprint $table) {
            $table->id();
            $table->string('slot_name'); // '9am-1pm'
            $table->string('slot_label'); // '9:00 AM - 1:00 PM'
            $table->time('start_time'); // 09:00:00
            $table->time('end_time'); // 13:00:00
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0); // Para ordenar horarios
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 3. Tabla para configuración avanzada (opcional)
        Schema::create('delivery_config', function (Blueprint $table) {
            $table->id();
            $table->string('config_key');
            $table->text('config_value');
            $table->string('config_type')->default('string'); // string, int, bool, json
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 4. Poblar con datos iniciales
        $this->seedInitialData();
    }

    /**
     * Poblar datos iniciales basados en la lógica actual
     */
    private function seedInitialData()
    {
        // Días de entrega actuales (Miércoles y Lunes)
        DeliveryDay::create([
            'day_name' => 'wednesday',
            'day_label' => 'Miércoles',
            'day_number' => 3,
            'is_active' => true,
            'priority' => 1,
            'notes' => 'Día principal de entrega'
        ]);

        DeliveryDay::create([
            'day_name' => 'monday',
            'day_label' => 'Lunes',
            'day_number' => 1,
            'is_active' => true,
            'priority' => 2,
            'notes' => 'Día alternativo de entrega'
        ]);

        // Horarios actuales
        DeliveryTimeSlot::create([
            'slot_name' => '9am-1pm',
            'slot_label' => '9:00 AM - 1:00 PM',
            'start_time' => '09:00:00',
            'end_time' => '13:00:00',
            'is_active' => true,
            'priority' => 1,
            'notes' => 'Horario matutino'
        ]);

        DeliveryTimeSlot::create([
            'slot_name' => '4pm-12pm',
            'slot_label' => '4:00 PM - 12:00 PM',
            'start_time' => '16:00:00',
            'end_time' => '24:00:00',
            'is_active' => true,
            'priority' => 2,
            'notes' => 'Horario vespertino/nocturno'
        ]);

        // Configuraciones del sistema
        DB::table('delivery_config')->insert([
            [
                'config_key' => 'cut_off_hour_morning',
                'config_value' => '13',
                'config_type' => 'int',
                'description' => 'Hora límite para horario matutino (formato 24h)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'config_key' => 'cut_off_hour_evening',
                'config_value' => '16',
                'config_type' => 'int',
                'description' => 'Hora límite para horario vespertino (formato 24h)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'config_key' => 'daily_cutoff_hour',
                'config_value' => '21',
                'config_type' => 'int',
                'description' => 'Hora límite diaria - después de esta hora no hay entregas (formato 24h)',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_config');
        Schema::dropIfExists('delivery_time_slots');
        Schema::dropIfExists('delivery_days');
    }
};
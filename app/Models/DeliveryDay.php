<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_name',
        'day_label',
        'day_number',
        'is_active',
        'priority',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'day_number' => 'integer',
        'priority' => 'integer'
    ];

    /**
     * Scope para obtener solo días activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para obtener días ordenados por prioridad
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('priority', 'asc')->orderBy('day_number', 'asc');
    }

    /**
     * Obtener días activos para la API
     */
    public static function getActiveDaysForAPI()
    {
        return self::active()->ordered()->get()->map(function($day) {
            return [
                'id' => $day->id,
                'name' => $day->day_name,
                'label' => $day->day_label,
                'number' => $day->day_number,
                'priority' => $day->priority
            ];
        });
    }
}
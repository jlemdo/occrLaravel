<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_name',
        'slot_label', 
        'start_time',
        'end_time',
        'is_active',
        'priority',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'priority' => 'integer',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s'
    ];

    /**
     * Scope para obtener solo slots activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para obtener slots ordenados por prioridad
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('priority', 'asc')->orderBy('start_time', 'asc');
    }

    /**
     * Verificar si este slot ya pasó para una fecha específica
     */
    public function hasPassed($forDate = null)
    {
        $now = now();
        $checkDate = $forDate ? \Carbon\Carbon::parse($forDate) : $now;
        
        // Si es fecha futura, nunca ha pasado
        if ($checkDate->isAfter($now->copy()->startOfDay())) {
            return false;
        }
        
        // Si es fecha pasada, siempre ha pasado
        if ($checkDate->isBefore($now->copy()->startOfDay())) {
            return true;
        }
        
        // Si es hoy, verificar hora
        $cutoffHour = (int) $this->start_time->format('H');
        return $now->hour >= $cutoffHour;
    }

    /**
     * Obtener slots activos para la API, opcionalmente filtrados por fecha
     */
    public static function getActiveSlotsForAPI($forDate = null)
    {
        $slots = self::active()->ordered()->get();
        
        return $slots->filter(function($slot) use ($forDate) {
            // Si no se especifica fecha, devolver todos
            if (!$forDate) {
                return true;
            }
            
            // Filtrar slots que ya pasaron
            return !$slot->hasPassed($forDate);
        })->map(function($slot) {
            return [
                'label' => $slot->slot_label,
                'value' => $slot->slot_name,
                'start_time' => $slot->start_time->format('H:i'),
                'end_time' => $slot->end_time->format('H:i'),
                'priority' => $slot->priority
            ];
        })->values();
    }
}
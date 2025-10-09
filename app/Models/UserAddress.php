<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    protected $table = 'user_addresses';
    
    protected $fillable = [
        'user_id',
        'address',
        'latitude',
        'longitude',
        'phone',
        'is_primary',
        'label'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public $timestamps = false; // Usamos solo created_at

    /**
     * Relación con el usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para obtener la dirección principal
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Establecer como dirección principal y desmarcar las demás
     */
    public function makePrimary()
    {
        // Desmarcar todas las demás direcciones del usuario como no primarias
        static::where('user_id', $this->user_id)
              ->where('id', '!=', $this->id)
              ->update(['is_primary' => false]);
        
        // Marcar esta como primaria
        $this->update(['is_primary' => true]);
    }
}
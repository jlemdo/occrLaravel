<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestAddress extends Model
{
    protected $table = 'guest_addresses';
    
    protected $fillable = [
        'guest_email',
        'address',
        'latitude',
        'longitude',
        'phone',
        'fcm_token',
        'fcm_topic',
        'session_id',
        'cart_data',
        'cart_updated_at'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'cart_data' => 'array',
        'cart_updated_at' => 'datetime',
    ];

    /**
     * Obtener la dirección de un guest por email
     */
    public static function getByEmail(string $email)
    {
        return static::where('guest_email', $email)->first();
    }

    /**
     * Crear o actualizar dirección de guest
     * CONSERVA cart_data y cart_updated_at existentes
     */
    public static function createOrUpdate(string $email, array $addressData)
    {
        $existing = static::where('guest_email', $email)->first();

        if ($existing) {
            // PRESERVAR cart_data y cart_updated_at si existen
            if (!isset($addressData['cart_data']) && $existing->cart_data) {
                $addressData['cart_data'] = $existing->cart_data;
            }
            if (!isset($addressData['cart_updated_at']) && $existing->cart_updated_at) {
                $addressData['cart_updated_at'] = $existing->cart_updated_at;
            }
        }

        return static::updateOrCreate(
            ['guest_email' => $email],
            $addressData
        );
    }
}
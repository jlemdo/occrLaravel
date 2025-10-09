<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingConfig extends Model
{
    use HasFactory;
    
    protected $table = 'shipping_config';
    
    protected $fillable = [
        'min_order_for_free_shipping',
        'standard_shipping_fee',
        'is_active',
        'description'
    ];

    protected $casts = [
        'min_order_for_free_shipping' => 'decimal:2',
        'standard_shipping_fee' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Obtener configuración activa de envío
     */
    public static function getActiveConfig()
    {
        return static::where('is_active', true)->first();
    }

    /**
     * Calcular costo de envío basado en subtotal
     */
    public static function calculateShippingCost($subtotal)
    {
        $config = static::getActiveConfig();
        
        if (!$config) {
            return 0; // Sin configuración, envío gratis
        }
        
        if ($subtotal >= $config->min_order_for_free_shipping) {
            return 0; // Envío gratis
        }
        
        return $config->standard_shipping_fee; // Costo estándar
    }

    /**
     * Verificar si califica para envío gratis
     */
    public static function qualifiesForFreeShipping($subtotal)
    {
        $config = static::getActiveConfig();
        
        if (!$config) {
            return true;
        }
        
        return $subtotal >= $config->min_order_for_free_shipping;
    }

    /**
     * Obtener monto faltante para envío gratis
     */
    public static function getAmountNeededForFreeShipping($subtotal)
    {
        $config = static::getActiveConfig();
        
        if (!$config || $subtotal >= $config->min_order_for_free_shipping) {
            return 0;
        }
        
        return $config->min_order_for_free_shipping - $subtotal;
    }
}
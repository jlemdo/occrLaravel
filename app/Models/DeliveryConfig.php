<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryConfig extends Model
{
    use HasFactory;

    protected $table = 'delivery_config';

    protected $fillable = [
        'config_key',
        'config_value',
        'config_type',
        'description'
    ];

    /**
     * Obtener un valor de configuración
     */
    public static function get($key, $default = null)
    {
        $config = self::where('config_key', $key)->first();
        
        if (!$config) {
            return $default;
        }
        
        // Convertir según el tipo
        switch ($config->config_type) {
            case 'int':
                return (int) $config->config_value;
            case 'bool':
                return filter_var($config->config_value, FILTER_VALIDATE_BOOLEAN);
            case 'json':
                return json_decode($config->config_value, true);
            default:
                return $config->config_value;
        }
    }

    /**
     * Establecer un valor de configuración
     */
    public static function set($key, $value, $type = 'string', $description = null)
    {
        $config = self::updateOrCreate(
            ['config_key' => $key],
            [
                'config_value' => is_array($value) ? json_encode($value) : $value,
                'config_type' => $type,
                'description' => $description
            ]
        );
        
        return $config;
    }

    /**
     * Obtener toda la configuración de delivery
     */
    public static function getDeliverySettings()
    {
        return [
            'cut_off_hour_morning' => self::get('cut_off_hour_morning', 13),
            'cut_off_hour_evening' => self::get('cut_off_hour_evening', 16),
            'daily_cutoff_hour' => self::get('daily_cutoff_hour', 21),
        ];
    }
}
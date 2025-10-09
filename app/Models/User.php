<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, CausesActivity, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
        'email',
        'password',
        'is_active',
        'enable2fa',
        'suspended',
        'country',
        'state',
        'usertype',
        'image',
		'is_active',
		'show_password',
		'intro',
		'dob',
		'address',
		'phone',
		'promotion_id',
		'promotional_discount',
		'apple_id',
		'fcm_token',
		'fcm_topic',
		'session_id',
		'cart_data',
		'cart_updated_at',
		'provider',
		'has_real_email',
		'email_type',
		'can_receive_emails'

    ];
public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() 
            ->useLogName('User Management') 
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs(); 
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'cart_data' => 'array',
        'cart_updated_at' => 'datetime',
    ];

    public function isActive()
    {
        if($this->is_active=='active'){
            return true;
        }else{
            return false;
        }
        
        
    }

    /**
     * Verificar si el usuario se registró con OAuth (Google/Apple)
     */
    public function isOAuthUser()
    {
        return in_array($this->provider, ['google', 'apple']);
    }

    /**
     * Obtener el nombre del proveedor formateado
     */
    public function getProviderNameAttribute()
    {
        return match($this->provider) {
            'google' => 'Google',
            'apple' => 'Apple ID',
            default => 'Local'
        };
    }

    /**
     * Verificar si el usuario puede recibir emails
     */
    public function canReceiveEmails()
    {
        return $this->can_receive_emails && 
               $this->has_real_email && 
               $this->email_type !== 'generated' &&
               $this->email_verified_at !== null;
    }

    /**
     * Verificar si el usuario puede recibir notificaciones push
     */
    public function canReceivePushNotifications()
    {
        return !empty($this->fcm_token);
    }

    /**
     * Estrategia de comunicación preferida para este usuario
     */
    public function getCommunicationStrategyAttribute()
    {
        if ($this->canReceiveEmails() && $this->canReceivePushNotifications()) {
            return 'both'; // Email + Push
        } elseif ($this->canReceiveEmails()) {
            return 'email'; // Solo email
        } elseif ($this->canReceivePushNotifications()) {
            return 'push'; // Solo push
        } else {
            return 'none'; // Sin comunicación directa
        }
    }

    /**
     * Obtener descripción del tipo de email para admin
     */
    public function getEmailTypeDescriptionAttribute()
    {
        return match($this->email_type) {
            'real' => 'Email real del usuario',
            'proxy' => 'Email proxy de Apple (privado)',
            'generated' => 'Email generado internamente (no válido)',
            default => 'Desconocido'
        };
    }


   

    /**
     * Define the relationship with the services table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    



    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
	 protected $fillable = [
        'userid',
        'order_number',  // Nuevo campo consistente con frontend
		'orderno',
		'status', // 🔧 AGREGADO: Campo status original
		'status_spanish', // Estado en español directo desde backend
		'dman',
		'customer_lat',
		'customer_long',
		'delivery_address', // 🔪 CIRUGÍA: Campo para dirección escrita
		'user_email',
		'need_invoice',
		'tax_details',
		'delivery_date',
		'delivery_slot', 
        'payment_status',
        'amount_paid', 
        'payment_id',
        // Campos de cupones
        'coupon_code',
        'coupon_discount',
        'coupon_type',
        'discount_amount',
        // 🚚 NUEVOS CAMPOS: Información de envío y totales
        'shipping_cost',
        'subtotal',
        'total_amount',
    ];
       public function orderDetails()
    {
        return $this->hasMany(Ordedetail::class, 'orderno');
    }
}

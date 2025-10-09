<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordedetail extends Model
{
    use HasFactory;
	 protected $fillable = [
        'userid',
		'orderno',
		'item_name',
		'item_price',
		'item_qty',
		'item_image'
		
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposalbattery extends Model
{
    protected $fillable = [
        'name',
        'coupon_code',
		'from',
		'to',
		'discount',
        'discount_type',
        'minimum_amount',
        'type',
        'is_coupon'
    ];
	use HasFactory;
}

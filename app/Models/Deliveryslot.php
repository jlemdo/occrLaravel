<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryslot extends Model
{
    use HasFactory;
	 protected $fillable = [
        'date',
		'slot_detail'
    ];
}

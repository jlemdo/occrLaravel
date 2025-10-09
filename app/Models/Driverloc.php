<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driverloc extends Model
{
    use HasFactory;
	 protected $fillable = [
        'orderid',
		'driver_lat',
		'driver_long'
    ];
}

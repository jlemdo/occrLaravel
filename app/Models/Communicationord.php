<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communicationord extends Model
{
    use HasFactory;
	 protected $fillable = [
        'orderid',
		'sender',
		'message'
    ];
}

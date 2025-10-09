<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Inverters extends Model
{
     use HasFactory, LogsActivity;
	 
	 protected $fillable = [
        'name',
        'unit',
        'quantity',
		'photo',
		'description',
		'price',
		'discount',
		'product_cat',
		'cost'
    ];
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() 
            ->useLogName('Food Management') 
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs(); 
    }
}

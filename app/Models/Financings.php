<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Financings extends Model
{
     use HasFactory, LogsActivity;
	 
	 protected $fillable = [
        'distance',
		'amount'
    ];
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() 
            ->useLogName('Delivery method Management') 
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs(); 
    }
}

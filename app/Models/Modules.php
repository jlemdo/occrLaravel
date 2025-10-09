<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Modules extends Model
{
     use HasFactory, LogsActivity;
	 
	 protected $fillable = [
        'name',
		'photo', 
		'description'
    ];
	
	
	public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() 
            ->useLogName('Modules Management') 
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs(); 
    }
}

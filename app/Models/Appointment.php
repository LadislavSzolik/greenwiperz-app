<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    protected $guarded = [];
    protected $casts = ['date' => 'date'];
    protected $appends = ['date_for_editing'];
    
    use HasFactory;    
    
    public function booking() {
        return $this->hasOne('App\Models\Booking');
    }    

    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    public function getDateForEditingAttribute()
    {       
        return $this->date->format('Y-m-d');
    }

    public function setDateForEditingAttribute($value)
    {            
        $this->date = Carbon::parse($value);
    }
   
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingTimeslot extends Model
{
    protected $fillable = ['booking_id', 'date', 'start_time','end_time','canceled_at'];
    protected $dates = ['canceled_at'];

    use HasFactory;
    use SoftDeletes;
    

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }    

    public function getCarbonDateAttribute() {    
       return new Carbon($this->date.' '.$this->start_time);
    }
   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTimeslot extends Model
{
    protected $fillable = ['date', 'start_time','end_time'];

    use HasFactory;

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

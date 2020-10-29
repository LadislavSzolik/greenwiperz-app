<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTimeslot extends Model
{
    protected $fillable = ['date', 'start_time','end_time'];

    use HasFactory;
    use SoftDeletes;

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

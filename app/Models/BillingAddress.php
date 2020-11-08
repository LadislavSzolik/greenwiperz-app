<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{

    protected $fillable = [
        'booking_id',
        'user_id', 
        'first_name',
        'last_name',
        'company_name',
        'street',
        'postal_code',
        'city',
        'country',
    ];
    use HasFactory;


    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

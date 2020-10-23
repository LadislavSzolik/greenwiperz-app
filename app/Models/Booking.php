<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'refno',
        'parking_route',
        'parking_street_number',
        'parking_postal_code',
        'parking_city',
        'vehicle_model',
        'number_plate',
        'vehicle_size',
        'vehicle_color',
        'has_extra_dirt',
        'has_animal_hair',
        'service_type',
        'service_duration',
        'service_price',
        'billing_first_name',
        'billing_last_name',
        'billing_street',
        'billing_postal_code',
        'billing_city',
        'billing_country',
        'notes',
        'internal_notes',        
    ];

    public function bookingTimeslot() {
        return $this->hasOne('App\Models\BookingTimeslot');
    }

    public function payment() {
        return $this->hasOne('App\Models\Payment');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}

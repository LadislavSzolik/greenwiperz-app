<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    protected $fillable = [
        'booking_id',      
        'service_type',  
        'service_duration',        
        'parking_street_number',
        'parking_route',
        'parking_city',
        'parking_postal_code',        
        'vehicle_model',
        'number_plate',
        'vehicle_size',
        'vehicle_color',
        'has_extra_dirt',
        'has_animal_hair',
        
    ];

    use HasFactory;

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

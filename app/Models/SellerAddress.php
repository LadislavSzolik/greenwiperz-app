<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerAddress extends Model
{
    protected $fillable = [        
        'booking_id',
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

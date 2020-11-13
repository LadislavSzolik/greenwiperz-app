<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id', 
        'receipt_nr',
        'price',
        'currency',
        'netto_price',
        'mwst_percent',
        'mwst_id',
        'transaction_id',
        'settled_amount',
        'paid_with',
        'quantity',
    ];



    public function getDisplayCreationDateAttribute() {
        return Carbon::parse($this->created_at)->format('d.m.Y H:i:s');
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

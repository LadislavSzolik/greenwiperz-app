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
        'receipt_nr',
        'paid_amount',
        'paid_with',
        'transaction_id',
    ];



    public function getDisplayCreationDateAttribute() {
        return Carbon::parse($this->created_at)->format('d.m.Y H:i:s');
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

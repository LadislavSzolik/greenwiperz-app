<?php

namespace App\Models;

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    protected $dates = ['tc_accepted_at', 'canceled_at', 'paid_at', 'completed_at' ];
    
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_nr', 
        'transaction_id',                      
        'notes',
        'internal_notes',
        'failed_at',
        'failed_reason',
        'tc_accepted_at',
        'paid_at',
        'completed_at',
        'completed_by',
        'canceled_at',
        'canceled_by',
        'internal_notes',
    ];
    

    public function bookingTimeslot() {
        return $this->hasOne('App\Models\BookingTimeslot');
    }

    public function bookingService() {
        return $this->hasOne('App\Models\BookingService');
    }

    public function billingAddress() {
        return $this->hasOne('App\Models\BillingAddress');
    }

    public function sellerAddress() {
        return $this->hasOne('App\Models\SellerAddress');
    }

    public function invoice() {
        return $this->hasOne('App\Models\Invoice');
    }

    public function receipt() {
        return $this->hasOne('App\Models\Receipt');
    }

    public function refund() {
        return $this->hasOne('App\Models\Refund');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function payment() {
        return $this->hasOne('App\Models\Payment');
    }
}

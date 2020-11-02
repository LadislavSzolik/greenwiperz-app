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
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'refno', 
        'transaction_id',       
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

    public function getMoneyPriceAttribute() {
        $money = new Money($this->service_price, new Currency('CHF'));
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        
        return $moneyFormatter->format($money);;
    }

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

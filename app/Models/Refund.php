<?php

namespace App\Models;

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id', 
        'refund_nr',
        'price',
        'currency',
        'netto_price',
        'mwst_percent',
        'mwst_id',
        'transaction_id',
        'refunded_amount',
    ];

    public function getDisplayPriceAttribute() {
        return number_format($this->price/100, 2);
    }

    public function getDisplayMwstPercentAttribute() {
        return number_format($this->mwst_percent/100, 2);
    }

    public function getDisplayNettoPriceAttribute() {
        return number_format($this->netto_price/100, 2);
    }

    public function getDisplayRefundedAmountAttribute() {
        return number_format($this->refunded_amount/100, 2);
    }

    public function getMoneyRefundedAmountAttribute() {
        $money = new Money($this->refunded_amount, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        
        return $moneyFormatter->format($money);
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }

}

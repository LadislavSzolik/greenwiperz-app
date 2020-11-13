<?php

namespace App\Models;

use Money\Money;
use Carbon\Carbon;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id', 
        'invoice_nr',                      
        'currency',
        'price',
        'netto_price',
        'mwst_percent',
        'mwst_id',
        'quantity',
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

    public function getDisplayCreationDateAttribute() {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function getMoneyPriceAttribute() {
        $money = new Money($this->price, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        
        return $moneyFormatter->format($money);
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

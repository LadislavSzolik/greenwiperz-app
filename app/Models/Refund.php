<?php

namespace App\Models;

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Refund
 *
 * @property int $id
 * @property int $booking_id
 * @property string $refund_nr
 * @property int $refunded_amount
 * @property int $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Booking $booking
 * @property-read mixed $formated_refunded_amount
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'refund_nr',
        'refunded_amount',
        'transaction_id',        
    ];

    public function getFormatedRefundedAmountAttribute() 
    {
        $money = new Money($this->refunded_amount, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        
        return $moneyFormatter->format($money);
    }

    public function booking() 
    {
        return $this->belongsTo('App\Models\Booking');
    }

}

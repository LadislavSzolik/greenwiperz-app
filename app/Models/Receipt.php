<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Receipt
 *
 * @property int $id
 * @property int $booking_id
 * @property string $receipt_nr
 * @property int $paid_amount
 * @property string $paid_with
 * @property int $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Booking $booking
 * @property-read mixed $display_creation_date
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt wherePaidWith($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereReceiptNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

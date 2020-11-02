<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_id',
        'transaction_id',
        'type',
        'status',
        'currency',
        'refno',
        'payment_method',
       
        'detail_auth_amount',
        'detail_auth_authcode',
        'detail_settle_amount',
        'detail_credit_amount',
        'detail_cancel_reversal',
        'detail_fail_reason',
        'detail_fail_msg',
        'paid_at',
        'refunded_at',     
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

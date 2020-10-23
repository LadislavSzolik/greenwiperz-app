<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'refno',
        'amount',
        'currency',
        'uppTransactionId',
        'pmethod',
        'reqtype',
        'uppMsgType',
        'status',
        'responseCode',
        'responseMessage',
        'errorCode',
        'errorMessage',
        'errorDetail',
        'aliasCC'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }
}

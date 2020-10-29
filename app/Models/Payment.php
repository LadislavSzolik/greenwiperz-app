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

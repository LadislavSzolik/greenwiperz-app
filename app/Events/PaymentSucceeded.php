<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class PaymentSucceeded
{
    use Dispatchable;

    public $user;
    public $payment;
    public $booking;

    public function __construct($user, $payment, $booking)
    {
        //
    }


}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/en-ch/payments/handlePaymentSucceeded',
        '/en-ch/payments/handlePaymentCanceled',
        '/en-ch/payments/handlePaymentFailed',
        '/de-ch/payments/handlePaymentSucceeded',
        '/de-ch/payments/handlePaymentCanceled',
        '/de-ch/payments/handlePaymentFailed',
    ];
}

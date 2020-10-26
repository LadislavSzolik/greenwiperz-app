<?php


class Datatrans
{
    public static function paymentPagesUrl() {
        return 'https://pay.'.(config('datatrans.sandbox') ? 'sandbox' : '').'.datatrans.com';
    }

    public static function serverToServerUrl() {
        return 'https://api.'.(config('datatrans.sandbox') ? 'sandbox' : '').'.datatrans.com';
    }


    public static function redirectToPaymentPages() {

    }
}

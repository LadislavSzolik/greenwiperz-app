<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Transaction security 
    |--------------------------------------------------------------------------
    |
    | The username and password will allow the application to call
    | the Datatrans API. API calls require Basic Auth.  
    | It contains a digital signature (an encrypted HashCode
    | HMAC-SHA256 in hexadecimal format).
    | 
    | Signed are parameters aliasCC (optional), MerchantId, Amount,
    | Currency and Reference number (concatenated).
    | Use the aliasCC value noAlias if the authorisation message must not use aliasCC.
    |
    */

    'sign2' => env('DATATRANS_SIGN2'),

  /*
    |--------------------------------------------------------------------------
    | Server to Server security 
    |--------------------------------------------------------------------------
    |
    | The username and password will allow the application to call
    | the Datatrans API. API calls require Basic Auth. 
    |
    */

    'merchant_id' => env('DATATRANS_MERCHANTID', null),

    'api_password' => env('DATATRANS_PASSW', null),

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | This is the default currency that will be used when generating charges
    | from your application. Of course, you are welcome to use any of the
    | various world currencies that are currently supported via Paddle.
    |
    */

    'currency' => env('DATATRANS_CURRENCY', 'CHF'),

    /*
    |--------------------------------------------------------------------------
    | Currency Locale
    |--------------------------------------------------------------------------
    |
    | This is the default locale in which your money values are formatted in
    | for display. To utilize other locales besides the default en locale
    | verify you have the "intl" PHP extension installed on the system.
    |
    */

    'currency_locale' => env('DATATRANS_CURRENCY_LOCALE', 'de'),

    /*
    |--------------------------------------------------------------------------
    | Datatrans Sandbox
    |--------------------------------------------------------------------------
    |
    | This option allows you to toggle between the Datatrans live environment
    | and its sandboxed environment. This feature is only available for
    | a select group of vendors and not a publicly available feature.
    |
    */

    'sandbox' => env('DATATRANS_SANDBOX', false),

    'mocked' => env('DATATRANS_MOCKED', true),

];

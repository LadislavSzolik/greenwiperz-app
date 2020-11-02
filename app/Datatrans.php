<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use App\Exceptions\DatatransException;
use Illuminate\Support\Facades\Config;


class Datatrans
{
   

    public static function apiBaseUrl() {
        return 'https://api.'.(config('datatrans.sandbox') ? 'sandbox.' : '').'datatrans.com';
    }

    public static function checkTransactionStatus($transactionId) {
        return static::makeApiCall('get','/v1/transactions/'.$transactionId, []);
    }

    public static function initiateTransaction(array $payload = []) {
        return static::makeApiCall('post','/v1/transactions',$payload);
    }

    public static function makeApiCall($method, $uri, array $payload = []) 
    {
        $merchantId = config('datatrans.merchant_id');
        $merchantPassw = config('datatrans.api_password');
        
        $response = Http::withBasicAuth($merchantId , $merchantPassw)->$method(static::apiBaseUrl().$uri, $payload);                

        if (Arr::exists($response, 'error')) {            
            throw new DatatransException($response['error']['message'], $response->status());
        }
        return $response;
    } 
}


// initiate a transaction 

// get back transaction id and a Location\
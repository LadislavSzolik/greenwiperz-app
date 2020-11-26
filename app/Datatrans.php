<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use App\Exceptions\DatatransException;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;


class Datatrans
{
    /** 
    * Contains the base url for every datatrans call.
    *  
    */  
    public static function apiBaseUrl() {
        return 'https://api.'.(config('datatrans.sandbox') ? 'sandbox.' : '').'datatrans.com';
    }


    /** 
    * Initiate transaction on Datatrans size
    *  
    */
    public static function initiateTransaction(array $payload = []) 
    {
        return static::makeApiCall('post','/v1/transactions',$payload);
    }

    /** 
    * Get the transaction status from Datatrans
    *  
    */
    public static function checkTransactionStatus($transactionId) 
    {
        return static::makeApiCall('get','/v1/transactions/'.$transactionId, []);
    }

    /** 
    * Trigger credit(Refund) transaction
    *  
    */
    public static function refundTransaction($transactionId, array $payload = []) 
    {
        return static::makeApiCall('post','/v1/transactions/'.$transactionId.'/credit',$payload);
    }

    /** 
    * Generic method to make an API Datatrans call
    *  
    */
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

    /** 
    * This method refunds the customer if refunding is applicable. 
    *  Apart from that creates the Refund object and updates the Booking
    */
    public static function handleBookingRefund(Booking $booking, $amount)
    {
        $amountToRefund = blank($amount) ? $booking->getRefundableAmount() : $amount;
        
        $response = Datatrans::checkTransactionStatus($booking->transaction_id);

        if($response['status'] == 'authorized' || $response['status'] == 'settled' || $response['status'] == 'transmitted') 
        {
            $payload = [
                'currency' => 'CHF',
                'refno' => $booking->booking_nr,
                'amount' => $amountToRefund,
            ];
            
            $response = Datatrans::refundTransaction($booking->transaction_id, $payload );

            if($response->status() < 299 && Arr::exists($response, 'transactionId') ) 
            {                                                
                $responseStatusCheck = Datatrans::checkTransactionStatus($response['transactionId']);                   
                // TODO: needs to type=credit
                $booking->refund()->create
                ([                   
                    'refund_nr' =>   Datatrans::generateRefundNumber($booking->user_id),
                    'transaction_id'    => $responseStatusCheck['transactionId'],
                    'refunded_amount'    => $responseStatusCheck['detail']['settle']['amount'],
                ]);
                $booking->transaction_id =  $responseStatusCheck['transactionId'];     
                $booking->save();                      
            }           
        }
    }

    /** 
    * Helper method to calculate refund serial number.
    *  
    */
    protected static function generateRefundNumber($user_id)
    {       
        $baseNumberStructure = 
        [     
            'receipt_id' => 'REF',       
            'date' => Carbon::now('GMT+2')->format('U'),
            'divider2' => '-',
            'userid' => str_pad($user_id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($baseNumberStructure);
    }
}
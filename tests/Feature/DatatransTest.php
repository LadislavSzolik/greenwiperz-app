<?php

namespace Tests\Feature;

use App\Datatrans;
use App\Exceptions\DatatransException;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatatransTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMakeApiCall_post_error()
    {   
        $initTransURI = '/v1/transactions';
        $initTransURL = Datatrans::apiBaseUrl().$initTransURI;

        $this->expectException(DatatransException::class);
       
        Http::fake([
            $initTransURL => Http::response(['error' => ['code'=> 'INVALID_PROPERTY', 'message'=> 'init.refno must be not null'] ], 400)
        ]);
                
        Datatrans::makeApiCall('post',$initTransURI);                             
    }

    public function testMakeApiCall_post_success()
    {   
        
        $initTransURI = '/v1/transactions';
        $initTransURL = Datatrans::apiBaseUrl().$initTransURI;
        Http::fake([
            $initTransURL => Http::response(['transactionId' => '201026110404967343' ], 201)
        ]);
              
        
        $response = Datatrans::makeApiCall('post',$initTransURI);        
       // dd($response->headers()['Content-Type'][0]);                             
        $this->assertSame($response->status(), 201);
    }

    public function testInitiateTransaction_success()
    {   
        $initTransURI = '/v1/transactions';
        $initTransURL = Datatrans::apiBaseUrl().$initTransURI;
        Http::fake([
            $initTransURL => Http::response(['transactionId' => '201026110404967343' ], 201)
        ]);
              
        $payload = ['currency'=>'CHF', 'refno'=> 'GW-0123456', 'amount'=> 1234, 'redirect' => ['successUrl' => 'https://f7d35f6f920e.ngrok.io/handlePaymentSucceeded','cancelUrl' => 'https://f7d35f6f920e.ngrok.io/handleCancelPayment','errorUrl' => 'https://f7d35f6f920e.ngrok.io/handleErrorPayment',]];

        $response = Datatrans::initiateTransaction( $payload);        
                
        $this->assertSame($response->status(), 201);
        $this->assertSame($response['transactionId'],'201026110404967343');
    }    


    public function testCheckTransactionStatus_success() {
        $transactionId = '201101103538422731';
        $checkTransURL = '/v1/transactions/';
        $checkTransURL = Datatrans::apiBaseUrl().$checkTransURL.$transactionId;
        Http::fake([
            $checkTransURL => Http::response(['status' => 'settled' ], 200)
        ]);
        $response = Datatrans::checkTransactionStatus( $transactionId );        
        $this->assertSame($response->status(), 200);
    }


    public function testRefundTransaction_success() {
        $transactionId = '201101103538422731';
        $baseUrl = '/v1/transactions/';
        $refundTransURL = Datatrans::apiBaseUrl().$baseUrl.$transactionId.'/credit';
        Http::fake([
            $refundTransURL => Http::response(['transactionId' => '201103192707588322' ], 200)
        ]);
        $response = Datatrans::refundTransaction( $transactionId );        
        $this->assertSame($response->status(), 200);
    }
    
    
}

<?php

namespace Tests\Feature;

use App\Datatrans;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentControllerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHandlePaymentSucceeded_success()
    {

        $transactionId = '201101103538422731'; 
        $checkTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId;

        Http::fake([
            $checkTransURL => Http::response([
                'transactionId' => '201101103538422731',
                'type' => 'payment',
                'status' => 'settled',
                'currency' => 'CHF',
                'refno' => '1234567890',
                'paymentMethod' => 'CDA', 
                'detail' => [
                    'authorize' => [ 'amount' => 5500 , 'acquirerAuthorizationCode' => 123],
                    'settle' => [ 'amount' => 5500],
                ], 
            ], 200)
        ]);
            
        Booking::factory()->for(User::factory())->state([
            'transaction_id' => '201101103538422731',
            'refno' => '1234567890'
        ])->create();

        
        $payload = ['datatransTrxId'=> '201101103538422731'];
        $response = $this->postJson('/payments/handlePaymentSucceeded', $payload);        
        $response->assertStatus(302);
        $this->assertDatabaseHas('payments', ['transaction_id' => '201101103538422731' ]);
    }
    



    /*

    */
    public function testHandlePaymentFailed_success()
    {

        $transactionId = '201101103538422731';
        $checkTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId;

        Http::fake([
            $checkTransURL => Http::response([
                'transactionId' => '201101103538422731',
                'type' => 'payment',
                'status' => 'settled',
                'currency' => 'CHF',
                'refno' => '1234567890',
                'paymentMethod' => 'CDA', 
                'detail' => [
                    'authorize' => [ 'amount' => 5500 , 'acquirerAuthorizationCode' => 123],
                    'fail' => [ 'reason' => 'declined', 'message' => 'Declined'],
                ], 
            ], 200)
        ]);
        
        $user = User::factory();
        $booking = Booking::factory()->for($user)->create();
        $booking->transaction_id = '201101103538422731';
        $booking->refno = '1234567890';
        $booking->save();
        
        $payload = ['datatransTrxId'=> '201101103538422731'];
        $response = $this->postJson('/payments/handlePaymentFailed', $payload);
        $response->assertStatus(302);
    }

    public function testHandlePaymentDoubleFailed_success()
    {

        $transactionId = '201101103538422731';
        $checkTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId;

        Http::fake([
            $checkTransURL => Http::response([
                'transactionId' => $transactionId,
                'type' => 'payment',
                'status' => 'settled',
                'currency' => 'CHF',
                'refno' => '1234567890',
                'paymentMethod' => 'CDA', 
                'detail' => [
                    'authorize' => [ 'amount' => 5500 , 'acquirerAuthorizationCode' => 123],
                    'fail' => [ 'reason' => 'declined', 'message' => 'Declined'],
                ], 
            ], 200)
        ]);
        
     $booking = Booking::factory()->state([
         'refno' => '1234567890',
        'transaction_id' => '201101103538422731',       
        ])->create();
        
        Payment::factory()->for(User::factory())->state([
            'transaction_id' => '201101103538422730',
            'status' => 'failed',
            'detail_fail_reason' => 'rejected',
            'detail_fail_msg' => 'rejected',
        ])->create([
            'booking_id' => $booking->id,
        ]);
                
        $payload = ['datatransTrxId'=> $transactionId];
        $response = $this->postJson('/payments/handlePaymentFailed', $payload);
       
        $response->assertStatus(302);
    }
}

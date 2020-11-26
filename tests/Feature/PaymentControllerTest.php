<?php

namespace Tests\Feature;

use App\Datatrans;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\BookingService;
use App\Models\Appointment;
use App\Models\BillingAddress;
use App\Models\Car;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentControllerTest extends TestCase
{

    use RefreshDatabase;
   
    public function testRedirectToDatatrans_success() {        
        $initTransURL = Datatrans::apiBaseUrl().'/v1/transactions';
        Http::fake([
            $initTransURL => Http::response(['transactionId' => '201026110404967343'], 201, ['Location' => 'SomeURL'])
        ]);
        $user = User::factory()->create();
        $booking = Booking::factory()->state(['customer_id' => $user->id,'booking_nr' => '1234567890',])->create();       
        $response = $this->actingAs($user)->get('/payments/redirectToDatatrans/'.$booking->id); 
        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', [ 'transaction_id' => '201026110404967343'] );
       
    }


    public function testHandlePaymentSucceeded_success()
    {
        Event::fake();
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
        $user = User::factory()->state([
            'email' => 'szolik.ladislav@gmail.com'
        ])->create();
        $appointment = Appointment::factory()->state([          
            'date' => '2020-12-12',
            'start_time' => '08:00:00',
        ])->create();        
        $booking = Booking::factory()->state([
            'customer_id' => $user->id,
            'transaction_id' => '201101103538422731',
            'booking_nr' => '1234567890',
            'appointment_id' => $appointment->id,
            'status' => 'pending',
        ])->has(Car::factory())->has(BillingAddress::factory())->create();    
        $payload = ['datatransTrxId'=> '201101103538422731'];
        $response = $this->post('/payments/handlePaymentSucceeded', $payload);       
        $response->assertStatus(302);
        $this->assertDatabaseCount('receipts', 1);
        $this->assertDatabaseHas('receipts', ['transaction_id' =>'201101103538422731']);
        $this->assertDatabaseHas('receipts', ['paid_amount' => 5500]);
    }
        

    public function testHandlePaymentFailed_success()
    {
        $transactionId = '201101103538422731';
        $checkTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId;
        Http::fake([
            $checkTransURL => Http::response([
                'transactionId' => $transactionId,
                'type' => 'payment',
                'status' => 'failed',
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
            'booking_nr' => '1234567890',
            'transaction_id' =>  $transactionId,  
            'status' => 'pending',     
        ])->has(Car::factory())->has(BillingAddress::factory())->create();                           
        $payload = ['datatransTrxId'=> $transactionId];
        $response = $this->post('/payments/handlePaymentFailed', $payload);               
        $response->assertStatus(302);
    }



    public function testHandlePaymentPopupCanceledByUser_success()
    {
        $transactionId = '201101103538422731'; 
        $checkTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId;
        Http::fake([
            $checkTransURL => Http::response([
                'transactionId' => '201101103538422731',
                'type' => 'payment',
                'status' => 'canceled',
                'currency' => 'CHF',
                'refno' => '1234567890',
                'paymentMethod' => 'CDA',                  
            ], 200)
        ]);           
        $user = User::factory()->create(); 
        $booking = Booking::factory()->state([
            'customer_id' => $user->id,
            'transaction_id' => '201101103538422731',
            'booking_nr' => '1234567890',  
            'status' => 'pending',       
        ])->has(Car::factory())->has(BillingAddress::factory())->create();
        $payload = ['datatransTrxId'=> '201101103538422731'];
        $response = $this->post('/payments/handlePaymentCanceled',$payload);        
        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', ['status'=> 'pending']);
        $this->assertDatabaseCount('receipts', 0);        
    }


}

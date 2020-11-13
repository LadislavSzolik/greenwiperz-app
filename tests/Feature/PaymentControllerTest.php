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
        $booking = Booking::factory()->state(['user_id' => $user->id,'booking_nr' => '1234567890',])->create();
        Invoice::factory()->create([ 'booking_id' => $booking->id, 'user_id' => $booking->user_id,]);
        $response = $this->actingAs($user)->get('/payments/redirectToDatatrans/'.$booking->id); 
        $this->assertDatabaseHas('bookings', [ 'transaction_id' => '201026110404967343'] );
        $response->assertStatus(302);
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
            'user_id' => $user->id,
            'transaction_id' => '201101103538422731',
            'booking_nr' => '1234567890',
            'appointment_id' => $appointment->id,
        ])->create();

       

        BookingService::factory()->state([
            'booking_id' => $booking->id,            
        ])->create();

        Invoice::factory()->create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
        ]);

        $payload = ['datatransTrxId'=> '201101103538422731'];
        $response = $this->postJson('/payments/handlePaymentSucceeded', $payload);        
        $response->assertStatus(302);
        $this->assertDatabaseCount('receipts', 1);
        $this->assertDatabaseHas('receipts', ['transaction_id' =>'201101103538422731']);
        $this->assertDatabaseHas('receipts', ['settled_amount' => 5500]);
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
        $booking->booking_nr = '1234567890';
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
         'booking_nr' => '1234567890',
        'transaction_id' => '201101103538422731',       
        ])->create();           
                
        $payload = ['datatransTrxId'=> $transactionId];
        $response = $this->postJson('/payments/handlePaymentFailed', $payload);
       
        $response->assertStatus(302);
    }



    public function testHandlePaymentCanceledByUser_success()
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
            
        $booking = Booking::factory()->for(User::factory())->state([
            'transaction_id' => '201101103538422731',
            'booking_nr' => '1234567890',
            'paid_at' => null,
        ])->create();

        Invoice::factory()->create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
        ]);

        $payload = ['datatransTrxId'=> '201101103538422731'];
        $response = $this->postJson('/payments/handlePaymentCanceled', $payload);        
        $response->assertStatus(302);
        $this->assertDatabaseCount('receipts', 0);        
    }


}

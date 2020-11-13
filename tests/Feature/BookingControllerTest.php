<?php

namespace Tests\Feature;

use App\Datatrans;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Models\SellerAddress;
use App\Models\BillingAddress;
use App\Models\BookingService;
use App\Models\Appointment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Event;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;



    public function testForcedBookingFullDeletion_success() {              
        $user = User::factory()->create();
        $appointment = Appointment::factory()->create();
        $booking = Booking::factory()->state([
            'user_id' => $user->id,
            'appointment_id' =>  $appointment->id,
        ])->create();

        $billingAddress = BillingAddress::factory()->state([
            'booking_id' => $booking->id,
        ])->create();

        $sellerAddress = SellerAddress::factory()->state([
            'booking_id' => $booking->id,
        ])->create();

        $bookingService = BookingService::factory()->state([
            'booking_id' => $booking->id,
        ])->create();
            
        $response = $this->actingAs($user)->post('/bookings/'.$booking->id.'/delete', ['id' => $booking->id]);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
        $this->assertDatabaseMissing('billing_addresses', ['id' => $billingAddress->id]);
        $this->assertDatabaseMissing('seller_addresses', ['id' => $sellerAddress->id]);
        $this->assertDatabaseMissing('booking_services', ['id' => $bookingService->id]);
    }




    public function testCancelBooking_success() {       

        Event::fake();
        
        $transactionId = '201101103538422731';   
        $newTransactionId = '201101103538422732';        
        $checkTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId;
        $creditTransURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$transactionId.'/credit';
        $checkTransAgainURL = Datatrans::apiBaseUrl().'/v1/transactions/'.$newTransactionId;

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
                    'settle' => [ 'amount' => 5500],
                ], 
            ], 200)
        ]);
        
        Http::fake([
            $creditTransURL => Http::response([
                'transactionId' => $newTransactionId,
                'acquirerAuthorizationCode' => '192707',               
            ], 200)
        ]);

        Http::fake([
            $checkTransAgainURL => Http::response([
                'transactionId' => $newTransactionId,
                'type' => 'payment',
                'status' => 'credit',
                'currency' => 'CHF',
                'refno' => '1234567890',
                'paymentMethod' => 'CDA', 
                'detail' => [
                    'authorize' => [ 'amount' => 5500 , 'acquirerAuthorizationCode' => 123],
                    'settle' => [ 'amount' => 5500],
                ], 
            ], 200)
        ]);
        
        $user = User::factory()->create();

        $Appointment = Appointment::factory()->create([           
            'start_time' => '22:14:00',
            'date' => '2020-11-03'
        ]);
        $booking = Booking::factory()->state([
            'user_id' => $user->id,
            'appointment_id' => $Appointment->id,
            'transaction_id' => $transactionId,
            'paid_at' => now(),
        ])->create();

        $invoice = Invoice::factory()->create([
            'user_id' => $user->id,
            'booking_id' => $booking->id,
        ]);

        $receipt = Receipt::factory()->create([
            'booking_id' => $booking->id,
            'transaction_id' =>  $transactionId,
        ]);

       
                
        $response = $this->actingAs($user)->post('/bookings/'.$booking->id.'/cancel');
        $response->assertStatus(302);        

        // does the new transaction id saved on booking?
        $this->assertDatabaseHas('bookings', ['transaction_id' => $newTransactionId  ]); 
         
        // does the timeslot freed up?
        $Appointment->refresh();
        $this->assertNotNull($Appointment->canceled_at);       
        $this->assertDatabaseCount('refunds',1);
        $this->assertDatabaseHas('refunds', ['refunded_amount' => 5500  ]);
    }

}

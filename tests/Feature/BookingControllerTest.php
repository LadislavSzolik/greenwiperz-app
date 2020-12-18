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
use App\Models\Car;
use Database\Seeders\RoleSeeder;
use Database\Seeders\TimeslotSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;

class BookingControllerTest extends TestCase
{
    
    use WithFaker;
    use RefreshDatabase;

    public function testCompleteNotWiper_fail()
    {        
        $booking = Booking::factory()->has(Appointment::factory())->has(BillingAddress::factory())->has(Car::factory())->for(User::factory(),'customer')->create();      
        $response = $this->actingAs( $booking->customer)->post('/bookings/'.$booking->id.'/complete');  
        $response->assertStatus(403);
    }

    public function testCompleteByWiper_success()
    {
        Event::fake();
        $this->seed(UserSeeder::class);             
        $wiperUser = User::factory()->create();
        $wiperUser->assignRole('greenwiper');        
        $booking = Booking::factory()->has(Appointment::factory())->has(BillingAddress::factory())->has(Car::factory())->for(User::factory(),'customer')->create([
            'status' => 'paid',
        ]);      
        $response = $this->actingAs($wiperUser)->post('/bookings/'.$booking->id.'/complete');  
        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings',['status'=> 'completed']);
        $this->assertDatabaseHas('appointments',['completed_by'=> $wiperUser->id ]);
        $response->assertSessionHas('message'); 
    }

    public function testShowBooking_success()
    {        
        $booking = Booking::factory()->has(Appointment::factory())->has(BillingAddress::factory())->has(Car::factory())->for(User::factory(),'customer')->create();      
        $response = $this->actingAs($booking->customer)->get('/bookings/'.$booking->id);         
        $response->assertOk();
        $this->assertDatabaseHas('bookings',['id'=> $booking->id]);
    }

    public function testCancelWithoutAppointment_fail()
    {
        $booking = Booking::factory()->has(BillingAddress::factory())->has(Car::factory())->for(User::factory(),'customer')->create();    
        $response = $this->actingAs($booking->customer)->post('/bookings/'.$booking->id.'/cancel');
        $response->assertStatus(403);        
    }

    public function testCancelInStatusCaneled_fail()
    {
        $booking = Booking::factory()
        ->has(Appointment::factory())
        ->has(BillingAddress::factory())
        ->has(Car::factory())
        ->for(User::factory(),'customer')
        ->create(['status'=> 'canceled']);
        $response = $this->actingAs($booking->customer)->post('/bookings/'.$booking->id.'/cancel');   
        $response->assertStatus(403);
    }

    public function testCancelPrivatePaidBooking_success() {       
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
        $booking = Booking::factory()
        ->has(Appointment::factory())
        ->has(BillingAddress::factory())
        ->has(Car::factory())
        ->for(User::factory(),'customer')->state([           
            'transaction_id' => $transactionId,    
            'status' => 'paid',         
        ])->create();              
        
        $response = $this->actingAs($booking->customer)->post('/bookings/'.$booking->id.'/cancel');       
        $response->assertStatus(302);      
        $response->assertSessionHas('message');         
        $this->assertDatabaseHas('bookings', ['transaction_id' => $newTransactionId  ]); 
        $this->assertDatabaseHas('bookings', ['status' => 'canceled' ]);                       
        $this->assertDatabaseCount('refunds',1);
        $this->assertDatabaseHas('refunds', ['refunded_amount' => 5500  ]);
    }

    public function testCancelPrivatePendingBooking_success()
    {
        Event::fake();      
        $booking = Booking::factory()
        ->has(Appointment::factory())
        ->has(BillingAddress::factory())
        ->has(Car::factory())
        ->for(User::factory(),'customer')->state([                     
            'status' => 'pending',         
        ])->create();               
        $response = $this->actingAs($booking->customer)->post('/bookings/'.$booking->id.'/cancel');       
        $response->assertStatus(302);      
        $response->assertSessionHas('message');          
        $this->assertDatabaseHas('bookings', ['status' => 'canceled' ]);                       
        $this->assertDatabaseCount('refunds',0);        
    }

    public function testDestroyFullPrivateBooking_success() {       
        $this->seed(UserSeeder::class);              
        $booking = Booking::factory()       
        ->has(Appointment::factory())
        ->has(BillingAddress::factory())
        ->has(Car::factory())->create();               
        $response = $this->actingAs($booking->customer)->delete('/bookings/'.$booking->id);
        $response->assertRedirect();
        $response->assertSessionHas('message');
        $this->assertDatabaseCount('appointments', 0);        
        $this->assertDatabaseCount('billing_addresses',0);       
        $this->assertDatabaseCount('cars',0);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function testDestroyPrivateBookingWithoutCar_success() {       
        $this->seed(UserSeeder::class);              
        $booking = Booking::factory()        
        ->has(Appointment::factory())
        ->has(BillingAddress::factory())
        ->create();               
        $response = $this->actingAs($booking->customer)->delete('/bookings/'.$booking->id);
        $response->assertRedirect();
        $response->assertSessionHas('message');
        $this->assertDatabaseCount('appointments', 0);        
        $this->assertDatabaseCount('billing_addresses',0);              
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function testDestroyPrivateBookingWithoutAppointment_success() {       
        $this->seed(UserSeeder::class);              
        $booking = Booking::factory()    
        ->has(BillingAddress::factory())
        ->has(Car::factory())->create();               
        $response = $this->actingAs($booking->customer)->delete('/bookings/'.$booking->id);
        $response->assertRedirect();
        $response->assertSessionHas('message');
        $this->assertDatabaseCount('appointments', 0);        
        $this->assertDatabaseCount('billing_addresses',0);              
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }


    public function testDestroyPrivateBookingWithoutBillingAddr_success() {       
        $this->seed(UserSeeder::class);              
        $booking = Booking::factory()        
        ->has(Appointment::factory())               
        ->has(Car::factory())->create();               
        $response = $this->actingAs($booking->customer)->delete('/bookings/'.$booking->id);
        $response->assertRedirect();
        $response->assertSessionHas('message');
        $this->assertDatabaseCount('appointments', 0);        
        $this->assertDatabaseCount('billing_addresses',0);              
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function testDestroyPaidPrivateBooking_fail()
    {
        $this->seed(UserSeeder::class);         
            
        $booking = Booking::factory()       
        ->has(Appointment::factory())
        ->has(BillingAddress::factory())
        ->has(Car::factory())->create([
            'status' => 'paid',
        ]);                 
        $response = $this->actingAs($booking->customer)->delete('/bookings/'.$booking->id);
        $response->assertStatus(403);
    }


}

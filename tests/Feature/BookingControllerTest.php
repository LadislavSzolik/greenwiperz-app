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

    public function testCheckoutStore()
    {               
        $this->seed(TimeslotSeeder::class);
        $user2 = User::factory()->create();

        $request = [                     
            'assignedTo' => $user2->id,                       

            'bookingDate' => '2020-11-12',
            'bookingTime' => '11:30',
            'locStreetNumber' => $this->faker->numberBetween(123,543),
            'locRoute' =>  $this->faker->streetName,
            'locCity' => $this->faker->city,
            'locPostalCode' => $this->faker->postcode,
            'serviceType' => 'outside',
            'duration' => $this->faker->numberBetween(45,120),

            'baseCost' => $this->faker->numberBetween(5500,12000),
            'extraCost' => $this->faker->numberBetween(0,300),
            'bruttoTotalAmount' => $this->faker->numberBetween(5500,12000),

            'carModel' =>  $this->faker->name,
            'numberPlate' => $this->faker->numerify('ZH########'),           
            'carColor' => $this->faker->colorName,
            'carSize' => 'small',

            'hasExtraDirt' => 0,
            'hasAnimalHair' => 0,

            'billFirstName' =>  $this->faker->firstName,
            'billLastName' =>  $this->faker->lastName,            
            'billCompanyName' =>  $this->faker->company,
            'billStreet' =>  $this->faker->streetName,
            'billPostalCode' =>  $this->faker->postcode,
            'billCity' =>  $this->faker->city,
            'billCountry' =>  $this->faker->country,
            'phone' => $this->faker->phoneNumber,
            'notes' => $this->faker->text(),
            '_token' => Session::token(),  
        ];
                          
        $response = $this->actingAs(User::factory()->create())->post('bookings/store', $request);
        $response->assertStatus(200);
        
        $this->assertDatabaseCount('bookings',1);
        $this->assertDatabaseCount('billing_addresses',2);
        $this->assertDatabaseCount('cars',2);
    }



    public function testBookingCompleteDeletion_success() {       
        $this->seed(UserSeeder::class);

        $user = User::factory()->create();       
      
        $booking = Booking::factory()->for(Appointment::factory())->has(BillingAddress::factory())->has(Car::factory())->create([
            'customer_id' => $user->id,
        ]);       
        
        $response = $this->actingAs($user)->delete('/bookings/'.$booking->id);
        $response->assertStatus(302);
        $this->assertDatabaseCount('appointments', 0);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
        $this->assertDatabaseCount('billing_addresses',0);       
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
            'customer_id' => $user->id,
            'appointment_id' => $Appointment->id,
            'transaction_id' => $transactionId,            
        ])->create();
       

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

<?php

namespace Tests\Feature;

use App\Datatrans;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\BookingTimeslot;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStoreBooking_success()
    {

        Http::fake();
       

        $user = User::factory()->create();
        $bookingData = [
            'refno' =>  $this->faker->numerify('GW########-#####'),         

            'parking_street_number' => $this->faker->buildingNumber(),
            'parking_route' => $this->faker->streetName(),
            'parking_city' => $this->faker->city(),
            'parking_postal_code' => $this->faker->postcode(),

            'vehicle_model' => $this->faker->word(),
            'number_plate' => $this->faker->numerify('ZH ######'),
            'vehicle_size' => $this->faker->randomElement(['small', 'medium', 'large','x-large']),
            'vehicle_color' => $this->faker->safeColorName(),
            'has_extra_dirt' => $this->faker->boolean(),
            'has_animal_hair' => $this->faker->boolean(),
            
            
            'service_type' => $this->faker->randomElement(['outside','inside-outside']),
            'service_duration' => $this->faker->numberBetween(45,120),        
            'service_price' => $this->faker->numberBetween(45,120),
            
            'notes' => $this->faker->text(),

            'billing_first_name' => $this->faker->firstName(),
            'billing_last_name' => $this->faker->firstName(),
            'billing_street' => $this->faker->firstName(),
            'billing_postal_code' => $this->faker->firstName(),
            'billing_city' => $this->faker->firstName(),
            'billing_country' => $this->faker->firstName(),
        ];


        $bookingDate = '2030-01-01';
        $startTime = Carbon::parse('08:00')->addMinutes(30)->format('H:i');
        $endTime = Carbon::parse('08:00')->addMinutes(30 + 45 - 1)->format('H:i');
        
        $bookingTimeslot = [    
            'date' => $bookingDate,
            'start_time' => $startTime,
            'end_time' => $endTime
        ];
    
        $response = $this->actingAs($user)->withSession(['bookingData' => $bookingData, 'bookingTimeslot'=> $bookingTimeslot])->get('/bookings/store');        

        $this->assertDatabaseHas('bookings', ['refno' => $bookingData['refno']]);
        $this->assertDatabaseHas('booking_timeslots', ['date' => $bookingDate ]);
    }


    public function testPermanentDeletion() {              
        $user = User::factory()->create();

        $booking = Booking::factory()->state([
            'user_id' => $user->id,
        ])->create();

        BookingTimeslot::factory()->create([
            'booking_id' =>  $booking->id,
        ]);
                
        $response = $this->actingAs($user)->post('/bookings/'.$booking->id.'/delete', ['id' => $booking->id]);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
        
    }

}

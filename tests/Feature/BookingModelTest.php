<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\SellerAddress;
use App\Models\BillingAddress;
use App\Models\BookingService;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\BillingAddressFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingModelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBookingCreated_success()
    {              
        $booking = Booking::factory()->create();
        $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
    }


    public function testBookingWithBillingAddressCreated_success()
    {              
        $booking = Booking::factory()->create();
        $booking->billingAddress()->create([
            'first_name' => 'FranK',
            'last_name' => 'Jonson',
            'street' => 'wehntalerstrasessse',  
            'postal_code' => 'ddd',
            'city' => 'Zurichx',
            'country' => 'Schweiz',
        ]);
        $this->assertDatabaseCount('billing_addresses',1);
    }

    public function testBookingWithCarCreated_success()
    {              
        $booking = Booking::factory()->create();
        $booking->car()->create([
            'car_model' => 'Honda',
            'car_color' => 'Black',
            'number_plate' => 'ZH1234567',
            'car_size' => 'small',  
        ]);
        $this->assertDatabaseCount('cars',1);
    }

    public function testBookingWithAppointmentCreated_success()
    {
        
        $booking = Booking::factory()->has(Appointment::factory())->create();
        
        $this->assertDatabaseHas('bookings',['id'=> $booking->id]);
    }

}

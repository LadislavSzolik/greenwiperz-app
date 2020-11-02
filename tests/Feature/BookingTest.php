<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBookingCreated_success()
    {    
        $booking = Booking::factory()->for(User::factory())->create();
        $this->assertDatabaseHas('bookings', ['id'=>$booking->id]);
    }
}

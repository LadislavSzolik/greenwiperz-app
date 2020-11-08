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
use App\Models\BookingTimeslot;
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
        $booking = Booking::factory()->for(User::factory())->create();
        $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
    }

    public function testBillingAddressCreated_success()
    {
        $booking = Booking::factory()->for(User::factory())->create();
        $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
        BillingAddress::factory()->create([
            'booking_id' => $booking->id,
        ]);
    }

    public function testSellerAddressCreated_success()
    {
        $booking = Booking::factory()->for(User::factory())->create();
        $seller = SellerAddress::factory()->create([
            'booking_id' => $booking->id,
        ]);
        $this->assertDatabaseHas('seller_addresses', ['id' => $seller->id]);
    }


    public function testBookingServicesCreated_success()
    {
        $booking = Booking::factory()->for(User::factory())->create();
        $bookingService = BookingService::factory()->create([
            'booking_id' => $booking->id,
        ]);
        $this->assertDatabaseHas('booking_services', ['id' => $bookingService->id]);
    }

    public function testBookingTimeslotCreated_success()
    {
        $booking = Booking::factory()->for(User::factory())->create();
        $timeslot = BookingTimeslot::factory()->create([
            'booking_id' => $booking->id,
        ]);
        $this->assertDatabaseHas('booking_timeslots', ['id' => $timeslot->id]);
    }

    public function testInvoiceCreated_success()
    {
        $booking = Booking::factory()->for(User::factory())->create();
        $invoice = Invoice::factory()->create([
            'booking_id'        => $booking->id,
            'user_id'           => $booking->user_id,
            'price'             => 5500,
            'netto_price'       => intval(round(floatval('5500') / (1 + floatval(config('greenwiperz.mwst_percent'))))),
            'mwst_percent'              => config('greenwiperz.mwst_percent'),
            'mwst_id'       => config('greenwiperz.company.mwst_id'),
        ]);

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id]);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentModelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        
        $booking = Booking::factory()->for(User::factory())->create();

        $paymentData = [
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'transaction_id' => '1234567889',
            'type' => 'payment',
            'status' => 'settled',
            'currency' => 'CHF',
            'refno' => '12345567890',
            'payment_method' => 'CDA',
        ];

        $user = User::find($booking->user_id)->first();

        $payment = $user->payments()->create($paymentData);
        $this->assertDatabaseHas('payments', ['id' => $payment->id]);
    }
}

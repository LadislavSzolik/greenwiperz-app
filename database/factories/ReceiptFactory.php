<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Booking;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receipt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'booking_id' => Booking::factory(),
            'receipt_nr' => 'REC12345678',
            'price' => '5500',
            'netto_price' => '5100',
            'mwst_percent' => '400',
            'mwst_id' => 'MWST 123.123.000',
            'transaction_id' => '123456789',
            'settled_amount' => '5500',
            'paid_with' => 'VIS',
        ];
    }
}

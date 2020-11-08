<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

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
            'invoice_nr' => $this->faker->randomNumber(8),
            'price' => $this->faker->randomNumber(4),
            'netto_price'=> $this->faker->randomNumber(4),
            'mwst_percent' => '0.077',    
            'mwst_id' => 'CH123.123.123.123',          
        ];
    }
}

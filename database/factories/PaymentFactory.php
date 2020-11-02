<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      
        return [
            'booking_id' => Booking::factory(),
            'transaction_id' => '123456789',
            'type' =>  'payment',
            'status' =>  'settled',
            'currency' =>  'CHF',
            'refno' =>  $this->faker->numerify('GW########-#####'),
            'payment_method' =>  'CDA', 
        ];
    }
}

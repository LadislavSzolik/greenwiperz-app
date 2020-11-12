<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Str;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    public function configure()
    {
        return $this->afterMaking(function (Booking $booking) {
            //
        })->afterCreating(function (Booking $booking) {
            //
        });
    }



    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), 
            'appointment_id' => Appointment::factory(),
            'booking_nr' =>  $this->faker->numerify('GW########-####'),             
            'transaction_id' => $this->faker->numerify('##################'),          
            'notes' => $this->faker->text(),
        ];
    }
}

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
            'booking_nr' =>  $this->faker->numerify('GW########-####'),
            'invoice_nr' =>  $this->faker->numerify('GW########-####'),
            'customer_id' => User::factory(), 
            'assigned_to' => User::factory(), 
            'status' => 'draft',
            'appointment_id' => Appointment::factory(),             
            'transaction_id' => $this->faker->numerify('##################'),     

            'booking_datetime' => now(),
           
            'loc_street_number' => $this->faker->streetAddress,
            'loc_route' =>  $this->faker->streetName,
            'loc_city' => $this->faker->city,
            'loc_postal_code' => $this->faker->postcode,
            'service_type' => 'outside',
            'duration' => $this->faker->numberBetween(45,120),

            'base_cost' => $this->faker->numberBetween(5500,12000),
            'extra_cost' => $this->faker->numberBetween(0,300),
            'brutto_total_amount' => $this->faker->numberBetween(5500,12000),
            'has_extra_dirt' => $this->faker->boolean(50),
            'has_animal_hair' => $this->faker->boolean(50),


            'gw_vat_number' => 'MWST 123.123.123',
            'gw_company_name' => 'Greenwiperz',
            'gw_street' => 'Grindwald',
            'gw_postal_code' => '8046',
            'gw_city' => 'Zurich',
            'phone' => $this->faker->phoneNumber,
            
            'notes' => $this->faker->text(),
        ];
    }
}





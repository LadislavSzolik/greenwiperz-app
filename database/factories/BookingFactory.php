<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'refno' =>  $this->faker->numerify('GW########-#####'),         
            'user_id' => User::factory(), 
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

            'billing_first_name' => $this->faker->firstName(),
            'billing_last_name' => $this->faker->firstName(),
            'billing_street' => $this->faker->firstName(),
            'billing_postal_code' => $this->faker->firstName(),
            'billing_city' => $this->faker->firstName(),
            'billing_country' => $this->faker->firstName(),
        ];
    }
}

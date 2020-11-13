<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingService;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_id' => Booking::factory(),
            'service_type' => 'outside',
            'service_duration' => 60,
            'parking_street_number' => $this->faker->streetAddress(),
            'parking_route' => $this->faker->streetAddress(),
            'parking_city'=> $this->faker->city(),
            'parking_postal_code'=> $this->faker->postcode(),
            'vehicle_model'=> $this->faker->name(),
            'number_plate' => 'ZH12345678',
            'vehicle_size'=> 'small',
            'vehicle_color'=> 'black',
            'has_extra_dirt'=> 0,
            'has_animal_hair'=> 0,
        ];
    }
}

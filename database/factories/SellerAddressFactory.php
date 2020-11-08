<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\SellerAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellerAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_id'        => Booking::factory(),
            'company_name'      => $this->faker->name(),
            'street'            => $this->faker->streetAddress(),
            'postal_code'       => $this->faker->postcode(),
            'city'              => $this->faker->city(),
            'country'           => $this->faker->country(),
        ];
    }
}

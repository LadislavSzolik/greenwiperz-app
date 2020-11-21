<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Booking;
use App\Models\BillingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BillingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'        => $this->faker->name(),
            'last_name'         => $this->faker->name(),
            'company_name'      => $this->faker->name(),
            'street'            => $this->faker->streetAddress(),
            'postal_code'       => $this->faker->postcode(),
            'city'              => $this->faker->city(),
            'country'           => $this->faker->country(),
        ];
    }
}

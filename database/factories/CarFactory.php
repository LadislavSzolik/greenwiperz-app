<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'car_model' =>  $this->faker->name,
            'number_plate' => $this->faker->numerify('ZH########'),           
            'car_color' => 'black',
            'car_size' => Arr::random(['small','medium']),
        ];
    }
}

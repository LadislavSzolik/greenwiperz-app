<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingTimeslot;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingTimeslotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingTimeslot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $timeslots = ['07:30:00'
        ,'07:45:00'
        ,'08:00:00'
        ,'08:15:00'
        ,'08:30:00'
        ,'08:00:00'
        ,'08:45:00'
        ,'09:00:00'
        ,'09:15:00'
        ,'09:30:00'
        ,'09:45:00'
        ,'10:00:00'
        ,'10:15:00'
        ,'10:30:00'
        ,'10:45:00'
        ,'11:00:00'
        ,'11:15:00'
        ,'11:30:00'
        ,'11:45:00'
        ,'12:00:00'
        ,'12:15:00'
        ,'12:30:00'
        ,'12:45:00'
        ,'13:00:00'
        ,'13:15:00'
        ,'13:30:00'
        ,'13:45:00'
        ,'14:00:00'
        ,'14:15:00'
        ,'14:30:00'
        ,'14:45:00'
        ,'15:00:00'
        ,'15:15:00'
        ,'15:30:00'
        ,'15:45:00'
        ,'16:00:00'
        ,'16:15:00'
        ,'16:30:00'
        ,'16:45:00'
        ,'17:00:00'
        ,'17:15:00'
        ,'17:30:00'];

        $indexOfSlot = $this->faker->numberBetween(0, 36);

        $startTime = $timeslots[$indexOfSlot];
        $endTime = $timeslots[$indexOfSlot+4];

        return [           
            'booking_id' => Booking::factory(),
            'date' => $this->faker->dateTimeBetween('now','next month')->format('Y-m-d'),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}

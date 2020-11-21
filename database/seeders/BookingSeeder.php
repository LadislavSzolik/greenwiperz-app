<?php

namespace Database\Seeders;

use App\Models\BillingAddress;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            
        Booking::factory()->has(BillingAddress::factory())->has(Car::factory())->count(10)->create();               
    }
}

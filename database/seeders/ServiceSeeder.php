<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'small', 'duration'=> 30, 'price'=>6000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'medium', 'duration'=> 45, 'price'=>7000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'large', 'duration'=> 45, 'price'=>8000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'x-large', 'duration'=> 60, 'price'=>9000,'created_at' => now(), 'updated_at'=> now() ]);

        DB::table('services')->insert(['type' => 'inside-outside-basic', 'vehicle_size' => 'small', 'duration'=> 45, 'price'=>11000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside-basic', 'vehicle_size' => 'medium', 'duration'=> 75, 'price'=>13000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside-basic', 'vehicle_size' => 'large', 'duration'=> 75, 'price'=>15000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside-basic', 'vehicle_size' => 'x-large', 'duration'=> 120, 'price'=>17000,'created_at' => now(), 'updated_at'=> now() ]);

        DB::table('services')->insert(['type' => 'inside-outside-premium', 'vehicle_size' => 'small', 'duration'=> 90, 'price'=>15000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside-premium', 'vehicle_size' => 'medium', 'duration'=> 105, 'price'=>17000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside-premium', 'vehicle_size' => 'large', 'duration'=> 105, 'price'=>19000,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside-premium', 'vehicle_size' => 'x-large', 'duration'=> 150, 'price'=>21000,'created_at' => now(), 'updated_at'=> now() ]);
    }
}

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
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'small', 'duration'=> 45, 'price'=>5500,'created_at' => now(), 'updated_at'=> now() ]); 
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'medium', 'duration'=> 45, 'price'=>6500,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'large', 'duration'=> 60, 'price'=>7500,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'outside', 'vehicle_size' => 'x-large', 'duration'=> 60, 'price'=>8500,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside', 'vehicle_size' => 'small', 'duration'=> 75, 'price'=>9500,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside', 'vehicle_size' => 'medium', 'duration'=> 90, 'price'=>11500,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside', 'vehicle_size' => 'large', 'duration'=> 105, 'price'=>13500,'created_at' => now(), 'updated_at'=> now() ]);
        DB::table('services')->insert(['type' => 'inside-outside', 'vehicle_size' => 'x-large', 'duration'=> 120, 'price'=>15500,'created_at' => now(), 'updated_at'=> now() ]);
    }
}

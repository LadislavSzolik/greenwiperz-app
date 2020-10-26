<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('timeslots')->insert(['timeslot' => '07:30:00', 'created_at' => now(), 'updated_at'=> now()]); 
        DB::table('timeslots')->insert(['timeslot' => '07:45:00', 'created_at' => now(), 'updated_at'=> now()]); 
        DB::table('timeslots')->insert(['timeslot' => '08:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '08:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '08:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '08:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '08:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '09:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '09:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '09:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '09:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '10:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '10:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '10:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '10:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '11:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '11:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '11:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '11:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '12:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '12:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '12:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '12:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '13:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '13:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '13:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '13:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '14:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '14:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '14:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '14:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '15:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '15:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '15:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '15:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '16:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '16:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '16:30:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '16:45:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '17:00:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '17:15:00', 'created_at' => now(), 'updated_at'=> now()]);
        DB::table('timeslots')->insert(['timeslot' => '17:30:00', 'created_at' => now(), 'updated_at'=> now()]);                  
    }
}

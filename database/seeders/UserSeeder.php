<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Ability;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $user1 = User::create([
            'name' => 'John',
            'email' => 'sz@gmail.com',
            'password' => Hash::make('password'),  
        ]);     

        DB::table('users')->insert([
            'name' => 'Harold',
            'email' => 'l@gmail.com',
            'password' => Hash::make('password'),       
        ]); */

        $user1 = User::create([
            'name' => 'admin',
            'email' => 'info@greenwiperz.ch',
            'password' => Hash::make('password'),  
        ]); 

        $role = Role::firstOrCreate([
            'name' => 'greenwiper',
        ]);

        Ability::firstOrCreate([
            'name' => 'manage_bookings'
        ]);
        
        $role->allowTo('manage_bookings');        
        $user1->assignRole('greenwiper');

    }
}

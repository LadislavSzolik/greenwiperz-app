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
        $user1 = User::create([
            'name' => 'Ladislav',
            'email' => 'szolik.ladislav@gmail.com',
            'password' => Hash::make('password'),  
        ]);     

        DB::table('users')->insert([
            'name' => 'Harold',
            'email' => 'szolik@gmail.com',
            'password' => Hash::make('password'),       
        ]);

        $role = Role::firstOrCreate([
            'name' => 'greenwiper',
        ]);

        Ability::firstOrCreate([
            'name' => 'view_appointments'
        ]);
        Ability::firstOrCreate([
            'name' => 'update_appointments'
        ]);

        
        $role->allowTo('view_appointments');
        $role->allowTo('update_appointments');

        $user1->assignRole('greenwiper');

    }
}

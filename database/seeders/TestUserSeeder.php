<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Harold',
            'email' => 'harold@gmail.com',
            'password' => Hash::make('password'),  
        ]); 

        User::create([
            'name' => 'Frank',
            'email' => 'frank@gmail.com',
            'password' => Hash::make('password'),  
        ]); 
    }
}

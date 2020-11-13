<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ServiceSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
      TimeslotSeeder::class,
      ServiceSeeder::class,
      RoleSeeder::class,
      UserSeeder::class,

    ]);
    }
}

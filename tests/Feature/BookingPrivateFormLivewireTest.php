<?php

namespace Tests\Feature;

use App\Http\Livewire\BookingPrivateForm;
use App\Models\BillingAddress;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TimeslotSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookingPrivateFormLivewireTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBookingFormEntry_success()
    {
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $this->seed(UserSeeder::class);

        $user = User::factory()->has(Car::factory())->has(BillingAddress::factory())->create();
             
        Livewire::actingAs($user);
        Livewire::test(BookingPrivateForm::class)                                                         
            ->call('mount')                       
            ->assertSet('carForBooking', $user->cars->first()->id);           
    }
}

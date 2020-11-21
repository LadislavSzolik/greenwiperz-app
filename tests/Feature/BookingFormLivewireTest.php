<?php

namespace Tests\Feature;

use App\Http\Livewire\BookingForm;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TimeslotSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookingFormLivewireTest extends TestCase
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

        $this->actingAs(User::factory()->create());

        Livewire::test(BookingForm::class)                                    
            ->set('locStreetNumber', '543')  
            ->set('locRoute', 'Street')  
            ->set('locCity', 'zurich')  
            ->set('locPostalCode', '8046')  
            ->set('carModel', 'BMW')  
            ->set('numberPlate', '12345678')                               
            ->set('carColor', 'black')                               
            ->set('hasExtraDirtLocal', 0)       
            ->set('hasAnimalHairLocal', 0)                               
            ->set('notes', 'text')
            ->set('billFirstName', 'Text')
            ->set('billLastName', 'Text')
            ->set('billStreet', 'Text')
            ->set('billPostalCode', 'Text')  
            ->set('billCity', 'Text')      
            ->set('billCountry', 'Text')              
            ->set('bookingDate', Carbon::now()->addDay()->format('Y-m-d'))      
            ->call('mount')           
            ->assertSet('bookingTime', '08:00')
            ->assertSet('bookingDate', Carbon::now()->addDay()->format('Y-m-d'));           
    }
}

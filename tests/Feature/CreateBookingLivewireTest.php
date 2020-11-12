<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Database\Seeders\UserSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TimeslotSeeder;
use App\Http\Livewire\Booking\Create;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBookingLivewireTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateBooking_success()
    {
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $this->seed(UserSeeder::class);

        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)                        
            ->set('termsAndConditions', true)  
            ->set('parkingStreetNumber', '543')  
            ->set('parkingRoute', 'Street')  
            ->set('parkingCity', 'zurich')  
            ->set('parkingPostalCode', '8046')  
            ->set('vehicleModel', 'BMW')  
            ->set('numberPlate', '12345678')                               
            ->set('hasExtraDirt', 0)       
            ->set('hasAnimalHair', 0)                               
            ->set('notes', 'text')
            ->set('billingFirstName', 'Text')
            ->set('billingLastName', 'Text')
            ->set('billingStreet', 'Text')
            ->set('billingPostalCode', 'Text')  
            ->set('billingCity', 'Text')      
            ->set('billingCountry', 'Text')              
            ->set('bookingDate', Carbon::now()->addDay()->format('Y-m-d'))      
            ->call('submitBooking')
            ->assertSet('travelTimeNeeded', 30)
            ->assertSet('bookingTime', '08:00')
            ->assertSet('bookingDate', Carbon::now()->addDay()->format('Y-m-d'));
        $this->assertDatabaseCount('bookings',1);                   
        $this->assertDatabaseCount('appointments',1); 
        $this->assertDatabaseCount('invoices',1); 
        $this->assertDatabaseCount('billing_addresses',1); 
        $this->assertDatabaseCount('seller_addresses',1); 
    }
}

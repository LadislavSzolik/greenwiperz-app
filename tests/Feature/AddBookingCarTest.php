<?php

namespace Tests\Feature;

use App\Http\Livewire\Booking\NewCarModal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddBookingCarTest extends TestCase
{
    use RefreshDatabase;

    public function testMountComponent_success()
    {
        Livewire::test(NewCarModal::class)
            ->call('mount')
            ->assertStatus(200);
    }

    public function testSaveCar_success()
    {
        Livewire::actingAs(User::factory()->create());
        Livewire::test(NewCarModal::class)
            ->set('newCar.car_model', 'BMW')
            ->set('newCar.number_plate', 'ZH12345678')
            ->set('newCar.car_color', 'brown')
            ->set('newCar.car_size', 'medium')
            ->call('saveCar')
            ->assertStatus(200);
        $this->assertDatabaseHas('cars', ['car_model' => 'BMW']);
    }

    public function testUserHasCarNow_success()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);
        Livewire::test(NewCarModal::class)
            ->set('newCar.car_model', 'BMW')
            ->set('newCar.number_plate', 'ZH12345678')
            ->set('newCar.car_color', 'brown')
            ->set('newCar.car_size', 'medium')
            ->call('saveCar')
            ->assertStatus(200);
        $this->assertNotNull($user->cars->first());
    }

    public function testEmitSaveEvent_success()
    {
        Livewire::actingAs(User::factory()->create());
        Livewire::test(NewCarModal::class)
            ->set('newCar.car_model', 'BMW')
            ->set('newCar.number_plate', 'ZH12345678')
            ->set('newCar.car_color', 'brown')
            ->set('newCar.car_size', 'medium')
            ->call('saveCar')
            ->assertEmitted('carSaved');
    }

}

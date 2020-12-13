<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;

class AddBookingCar extends Component
{
    public $showCarModal = false;
    public $newCar;

    protected $listeners = ['createCar'];

    protected $rules = [
        'newCar.car_model' => 'required|min:3',
        'newCar.number_plate' => 'required|min:6',
        'newCar.car_color' => 'required',
        'newCar.car_size' => 'required',   
    ];

    public function mount()
    {
        $this->newCar =  Car::make();
    }
    

    public function createCar()
    {        
        $this->newCar =  Car::make();   
        $this->showCarModal = true;
    }

    public function saveCar()
    {
        $this->validate();
        auth()->user()->cars()->save($this->newCar);        
        $this->showCarModal = false;     
        $this->emit('carSaved');
    }
    
    public function render()
    {
        return view('livewire.add-booking-car');
    }
}

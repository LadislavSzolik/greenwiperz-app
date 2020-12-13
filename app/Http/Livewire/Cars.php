<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;

class Cars extends Component
{
    use WithPagination;
    public $showModal = false;
    public Car $editing; 

    protected $rules = [
        'editing.car_model' => 'required|min:3',
        'editing.number_plate' => 'required|min:6',
        'editing.car_color' => 'required',
        'editing.car_size' => 'required',
    ];

    public function mount()
    {
        $this->editing = $this->makeBlankCar();
    }

    public function makeBlankCar()
    {
        return Car::make();
    }

    public function create()
    {
        $this->editing = $this->makeBlankCar();        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();                     
        auth()->user()->cars()->save($this->editing);
        $this->showModal = false;
    }

    public function delete(Car $car)
    {
        $car->delete();
    }

    public function edit(Car $car)
    {
        if($this->editing) 

        if ($this->editing->isNot($car)) $this->editing = $car;

        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.cars', ['cars' => auth()->user()->cars()->paginate(10)]);
    }
}

<?php

namespace App\Http\Livewire\Rating;

use App\Models\Rating;
use Livewire\Component;

class ShowRatings extends Component
{
    

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.rating.show-ratings', ['ratings'=> Rating::where('is_favorite',1)->get()]);
    }
}

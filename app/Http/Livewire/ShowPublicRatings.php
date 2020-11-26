<?php

namespace App\Http\Livewire;

use App\Models\Rating;
use Livewire\Component;

class ShowPublicRatings extends Component
{
    

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.show-public-ratings', ['ratings'=> Rating::where('is_favorite',1)->get()]);
    }
}

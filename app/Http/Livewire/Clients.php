<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Clients extends Component
{
    public function render()
    {
        return view('livewire.clients', ['users' => User::doesntHave('roles')->paginate(10)]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $showModal = false;
    public User $editing; 

    public function rules()
    {
        return [
            'editing.name' => ['required', 'string', 'max:255'],
            'editing.email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'], 
            'editing.password' => ['required', 'string', new Password],                
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankUser();
    }

    public function makeBlankUser()
    {
        return User::make();
    }

    public function create()
    {
        $this->editing = $this->makeBlankUser();        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();              
        $this->editing->fill([
            'password' => Hash::make($this->editing->password),
        ])->save();
        $this->editing->assignRole('greenwiper');
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.users', ['users' => User::whereHas('roles', function (Builder $query) {
            $query->where('name', 'greenwiper');
        })->paginate(10)]);
    }
}

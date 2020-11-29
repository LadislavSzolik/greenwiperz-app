<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination;
    use WithSorting;

    protected $queryString = ['sortField','sortDirection'];

    public function mount()
    {
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
    }

    public function getRowsProperty()
    {
        $query = User::doesntHave('roles')->withCount('bookings');
        return $this->applySorting($query)->paginate(10);
    }

    public function render()
    {
        return view('livewire.clients', ['users' => $this->rows ]);
    }
}

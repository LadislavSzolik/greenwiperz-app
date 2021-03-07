<?php

namespace App\Http\Livewire\Service;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Services;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServices extends Component
{
    use WithPagination;
    use WithSorting;

    public $showModal = false;
    public Services $editing;

    public function rules() { return [
        'editing.duration' => 'required|int',
        'editing.price' => 'required|int',
    ]; }

    public function mount()
    {
        $this->sortField = 'type';
        $this->sortDirection = 'asc';
    }

    public function getRowsProperty()
    {
        $query = \DB::table('services');
        //var_dump($query);
        return $this->applySorting($query)->paginate(15);
    }
    public function render()
    {
        return view('livewire.service.admin-services',['services' => $this->rows ]);
    }
}

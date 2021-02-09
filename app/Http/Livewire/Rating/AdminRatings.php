<?php

namespace App\Http\Livewire\Rating;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Rating;
use Livewire\Component;
use Livewire\WithPagination;

class AdminRatings extends Component
{

    use WithPagination;
    use WithSorting;

    public $showModal = false;
    public Rating $editing; 

    public function rules() { return [
        'editing.display_name' => 'required|min:3',
        'editing.level' => 'required|in:'.collect(Rating::LEVELS)->keys()->implode(','),        
        'editing.comment' => 'required|min:5',
    ]; }

    public function mount()
    {
        $this->sortField = 'display_name';
        $this->sortDirection = 'asc';
        $this->editing = $this->makeBlankRating();   
    }

    public function makeBlankRating()
    {
        return Rating::make();
    }

    public function create()
    {        
        $this->editing = $this->makeBlankRating();        
        $this->showModal = true;
    }

    public function edit(Rating $rating)
    {
        if ($this->editing->isNot($rating)) $this->editing = $rating;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();              
        $this->editing->save();        
        $this->showModal = false;
    }

    public function markAsFavorite(Rating $rating)
    {
        $rating->is_favorite = 1;
        $rating->save();
    }

    public function removeAsFavorite(Rating $rating)
    {
        $rating->is_favorite = 0;
        $rating->save();
    }

    public function delete(Rating $rating)
    {
        $rating->delete();
    }

    public function getRowsProperty()
    {
        $query = Rating::with('user');
        return $this->applySorting($query)->paginate(15);
    }

    public function render()   
    {
        return view('livewire.rating.admin-ratings',['ratings' => $this->rows ]);
    }
}

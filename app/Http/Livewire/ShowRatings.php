<?php

namespace App\Http\Livewire;

use App\Models\Rating;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRatings extends Component
{

    use WithPagination;
    public $showModal = false;
    public Rating $editing; 

    public function rules() { return [
        'editing.display_name' => 'required|min:3',
        'editing.level' => 'required|in:'.collect(Rating::LEVELS)->keys()->implode(','),        
        'editing.comment' => 'required|min:5',
    ]; }

    public function mount()
    {
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

    public function render()   
    {
        return view('livewire.show-ratings',['ratings' => Rating::orderBy('created_at','desc')->paginate(20) ]);
    }
}

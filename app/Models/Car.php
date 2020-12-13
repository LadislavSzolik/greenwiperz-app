<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    const COLORS = [
        'black',
        'gray',
        'silver', 
        'white', 
        'red', 
        'orange',
        'yellow', 
        'brown', 
        'green', 
        'teal',
        'pink',
    ];

    protected $fillable = [
        'car_model', 'number_plate', 'car_color', 'car_size'
    ];

    public function carable()
    {
        return $this->morphTo();
    }

    public function getCarStringToSelectAttribute()
    {
        return $this->car_model.', '.$this->number_plate.', '.__($this->car_color).', '.__($this->car_size);
    }
}
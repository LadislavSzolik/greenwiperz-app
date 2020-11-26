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

    protected $guarded = [];

    public function carable()
    {
        return $this->morphTo();
    }

    public function getCarColorNameAttribute()
    {
        $en_colors = [];
    }
}

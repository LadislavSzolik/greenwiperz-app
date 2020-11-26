<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['name_for_public'];

    const LEVELS = [
        "0" => "I did not like it.",
        "1" => "A lot to improve",
        "2" => "More less ok.",
        "3" => "It is fine",
        "4" => "You're awesome",
    ];

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getNameForPublicAttribute()
    {
        if($this->user) {
            return $this->user->name;
        }else 
        {
            return $this->display_name;
        }
    }
}

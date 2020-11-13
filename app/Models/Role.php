<?php

namespace App\Models;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function abilities(){
        return $this->belongsToMany('App\Models\Ability')->withTimestamps();
    }
    
    public function users() 
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
    

    public function allowTo($ability)
    {
        if (is_string($ability))
        {
            $ability = Ability::whereName($ability)->firstOrFail();
        }
        $this->abilities()->syncWithoutDetaching($ability);
    }
}

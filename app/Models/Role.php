<?php

namespace App\Models;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Ability[] $abilities
 * @property-read int|null $abilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

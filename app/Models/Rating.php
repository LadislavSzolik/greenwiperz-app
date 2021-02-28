<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rating
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $display_name
 * @property int $level
 * @property string|null $comment
 * @property int $is_favorite
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $name_for_public
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereIsFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUserId($value)
 * @mixin \Eloquent
 */
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

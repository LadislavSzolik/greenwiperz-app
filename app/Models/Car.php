<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property string $car_model
 * @property string $car_color
 * @property string $number_plate
 * @property string $car_size
 * @property string $carable_type
 * @property int $carable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $carable
 * @property-read mixed $car_string_to_select
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCarableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereNumberPlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
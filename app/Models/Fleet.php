<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fleet
 *
 * @property int $id
 * @property int $outside
 * @property int $inoutside
 * @property string $car_size
 * @property string $fleetable_type
 * @property int $fleetable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereCarSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereFleetableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereFleetableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereInoutside($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereOutside($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fleet extends Model
{
    use HasFactory;

    protected $fillable = [ 'outside', 'inoutsidebasic', 'inoutsidepremium', 'car_size'];
}

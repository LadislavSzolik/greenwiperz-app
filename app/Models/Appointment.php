<?php
/**
 *
 */

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Appointment
 *
 * @property int $id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $start_time
 * @property string $end_time
 * @property string|null $completed_at
 * @property int|null $completed_by
 * @property int|null $assigned_to
 * @property int|null $booking_id
 * @property string|null $canceled_at
 * @property int|null $canceled_by
 * @property int $is_vacation
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $assignedTo
 * @property-read \App\Models\Booking|null $booking
 * @property string $date_for_editing
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCanceledBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCompletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereIsVacation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereUserId($value)
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    protected $guarded = [];
    protected $casts = ['date' => 'date'];
    protected $appends = ['date_for_editing'];

    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking() {
        return $this->belongsTo('App\Models\Booking');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    /**
     * @return string
     */
    public function getDateForEditingAttribute()
    {
        return $this->date->format('Y-m-d');
    }

    /**
     * @param $value
     */
    public function setDateForEditingAttribute($value)
    {
        $this->date = Carbon::parse($value);
    }

}

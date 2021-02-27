<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WaitingVisitor
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingVisitor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WaitingVisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property \App\Models\User|null $therapist
 * @property int $session_type_id
 * @property string $date_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SessionType|null $classType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession whereDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession whereSessionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession whereTherapist($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledSession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ScheduledSession extends Model
{
    use HasFactory;

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function classType()
    {
        return $this->belongsTo(SessionType::class);
    }

}

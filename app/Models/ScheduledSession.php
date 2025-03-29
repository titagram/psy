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

    protected $fillable =[
        'session_type_id',
        'date_time',
        'therapist',
    ];

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist');
    }

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

    //Funzione per admin
    public function bookings()
    {
        return $this->belongsToMany(User::class, 'bookings');
    }

    public function scopeUpcoming(Builder $query)
    {
        return $query->where('date_time', '>', now());
    }

    public function scopeNotBooked(Builder $query)
    {
        return $query->whereDoesntHave('patients', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }

    




}

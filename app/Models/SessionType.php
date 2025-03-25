<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $minutes
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ScheduledSession> $scheduledClasses
 * @property-read int|null $scheduled_classes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SessionType extends Model
{
    use HasFactory;

    public function scheduledClasses()
    {
        return $this->hasMany(ScheduledSession::class);
    }

}

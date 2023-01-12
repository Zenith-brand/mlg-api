<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Client extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name'];
    protected static $logFillable = true;
    protected static $logName = "Client";

    public function tapActivity(Activity $activity, string $eventName)
    {
        // Add custom field
        $activity->causer_ip = request()->ip();

    }


    public function timesheet(): HasMany
    {
        return $this->hasMany(timesheet::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = ['title', 'content', 'noteable_id', 'noteable_type'];
    protected static $logFillable = true;
    protected static $logName = "Note";

    // Activity log
    public function tapActivity(Activity $activity, string $eventName)
    {
        // Add custom field
        $activity->causer_ip = request()->ip();

    }
    
    public function noteable()
    {
        return $this->morphTo();
    }
}

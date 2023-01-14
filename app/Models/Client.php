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

    protected $fillable = ['name', 'clients_status'];
    protected static $logFillable = true;
    protected static $logName = "Client";

    // Search scope
    public function scopeSearch($query, $name, $clients_status)
    {
        // http://127.0.0.1:8000/api/clients?page=1&page_size=5&name=n&clients_status=active
        $searchQuery = $query->where('name', 'LIKE', '%'.$name.'%');
        if ($clients_status != null) {
            $searchQuery ->where('clients_status', 'LIKE', $clients_status);
        }
        return $searchQuery;
    }

    // Activity log
    public function tapActivity(Activity $activity, string $eventName)
    {
        // Add custom field
        $activity->causer_ip = request()->ip();

    }


    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function note()
    {
        return $this->morphMany(Note::class, 'noteable');
    }
}

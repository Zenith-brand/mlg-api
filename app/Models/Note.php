<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Note extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['title', 'content', 'noteable_id', 'noteable_type'];
    protected static $logFillable = true;
    protected static $logName = "Note";
    
    public function noteable()
    {
        return $this->morphTo();
    }
}

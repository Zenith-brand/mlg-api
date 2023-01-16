<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'forename',
        'surname',
        'email',
        'password',
        'ref_number',
        'date_registered',
        // 'address',
        // 'postcode',
        // 'country',
        // 'region',
        // 'area',
        'tel_number',
        'mobile_phone',
        'work_tel',
        'date_of_birth',
        'age',
        'nationality',
        'ethnic_origin',
        'user_status',
        'include_in_mail_shots',
        'word',
        'email',
        'sms',
        'notes',
        'last_contact_log'

    ];

    // ===== Logs Activity =====

    // protected static $logFillable = true;
    protected static $logName = "User";
    protected static $logAttributes = ['forename', 'email', 'created_at','tel_number'];

        // Activity log
        public function tapActivity(Activity $activity, string $eventName)
        {
            // Add custom field
            $activity->causer_ip = request()->ip();
    
        }

    // ===== Search Scope =====
    public function scopeSearch($query, $name)
    {
        $searchQuery = $query->where('forename', 'LIKE', '%'.$name.'%')
        ->orWhere('surname', 'LIKE', '%'.$name.'%');
        return $searchQuery;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function user_status(): HasOne
    // {
    //     return $this->hasOne(User_status::class);
    // }
    public function user_status(): BelongsTo
    {
        return $this->belongsTo(User_status::class);
    }

    public function timesheet(): HasMany
    {
        return $this->hasMany(timesheet::class);
    }

    public function note()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    /**
     * Get all of the addresses for the user.
     */
    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    // public function users()
    // {
    //     return $this->morphedByMany(Client::class, 'adressable');
    // }

}

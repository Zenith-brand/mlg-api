<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'address',
        'postcode',
        'country',
        'region',
        'area',
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

}

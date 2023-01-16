<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'addressable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'addressable');
    }
    // public function address_type()
    // {
    //     return $this->hasOne(Address_type::class);
    // }
}


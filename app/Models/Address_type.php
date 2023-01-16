<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address_type extends Model
{
    use HasFactory, SoftDeletes;

    public function addressables()
    {
        return $this->hasMany(Addressables::class);
    }
}

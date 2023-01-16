<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addressables extends Model
{
    use HasFactory, SoftDeletes;

    public function address_type()
    {
        return $this->belongsTo(Address::class);
    }
}

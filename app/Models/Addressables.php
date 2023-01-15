<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addressables extends Model
{
    use HasFactory;

    public function address_type()
    {
        return $this->belongsTo(Address::class);
    }
}

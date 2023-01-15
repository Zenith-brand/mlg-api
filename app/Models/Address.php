<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function clients()
    {
        return $this->morphedByMany(Client::class, 'adressable');
    }
}

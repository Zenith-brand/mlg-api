<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Candidate extends Model
{
    use HasFactory;

    // ===== Search Scope =====
    public function scopeSearch($query, $name)
    {
        $searchQuery = $query->where('forename', 'LIKE', '%'.$name.'%')
        ->orWhere('surname', 'LIKE', '%'.$name.'%');
        return $searchQuery;
    }

        /**
     * Get all of the addresses for the client.
     */
    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //
    protected $fillable = ['name', 'type', 'capacity', 'status'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

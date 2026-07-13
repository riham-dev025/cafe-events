<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['name', 'description', 'duration_minutes', 'price', 'capacity', 'status'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

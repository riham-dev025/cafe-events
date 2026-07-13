<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table = 'staff'; // Explicitly define because plural is normally "staff", not "staffs"

    protected $fillable = ['user_id', 'position', 'status'];

    // Staff links to a specific User account
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A Staff member can be assigned to many Bookings
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

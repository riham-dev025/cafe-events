<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password_hash',
        'phone',
        'role_id',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_hash' => 'hashed',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // A User belongs to a single Role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // A User might also be a Staff member (1-to-1)
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    // A User can have many Orders
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // A User can have many Bookings
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
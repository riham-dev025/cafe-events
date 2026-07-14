<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 
        'service_id', 
        'resource_id', 
        'staff_id', 
        'booking_start', 
        'booking_end', 
        'seats_reserved', 
        'booking_status', 
        'payment_method', 
        'payment_status', 
        'notes'
    ];

    protected $casts = [
        'booking_start' => 'datetime',
        'booking_end' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
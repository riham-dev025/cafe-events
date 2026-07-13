<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['user_id', 'order_status', 'total_amount', 'payment_method', 'payment_status'];

    // An order belongs to a customer (User)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // An order is broken down into multiple items
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

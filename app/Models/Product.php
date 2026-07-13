<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock', 'image', 'status'];

    // A product belongs to one category
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // A product can appear in multiple order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

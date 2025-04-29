<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon; // مهم إذا استخدمت Carbon مباشرة

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'name', 'description', 'price', 'discount_price', 'stock', 'expiry_date', 'image_url'];

    public function store()
    {
        return $this->belongsTo(Store::class); // كل منتج ينتمي إلى متجر معين
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class); // كل منتج يمكن أن يحتوي على عدة خصومات
    }

    public function discount()
    {
        return $this->hasOne(Discount::class)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // كل منتج يمكن أن يكون جزءًا من عدة طلبات
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}
// Product.php
public function reviews()
{
    return $this->hasMany(Review::class);
}


}

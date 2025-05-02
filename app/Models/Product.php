<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'description',
        'price',
        'discount_price',
        'stock',
        'expiry_date',
        'image_url'
    ];

    // ⬇️ علاقات المنتج

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    // ✅ الخصم الفعّال الحالي فقط
    public function discount()
    {
        return $this->hasOne(Discount::class)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

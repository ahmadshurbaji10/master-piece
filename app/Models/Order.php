<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class); // كل طلب ينتمي إلى مستخدم واحد
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // كل طلب يحتوي على عدة منتجات
    }
    public function items()
{
    return $this->hasMany(OrderItem::class);
}

}

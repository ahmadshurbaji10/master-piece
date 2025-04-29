<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class); // كل عنصر طلب مرتبط بطلب معين
    }

    public function product()
    {
        return $this->belongsTo(Product::class); // كل عنصر طلب مرتبط بمنتج معين
    }
    
}

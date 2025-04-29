<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'location'];

    public function user()
    {
        return $this->belongsTo(User::class); // كل متجر مرتبط بمستخدم واحد (البائع)
    }

    public function products()
    {
        return $this->hasMany(Product::class); // كل متجر يحتوي على عدة منتجات
    }
}

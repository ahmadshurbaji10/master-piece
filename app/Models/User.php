<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function store()
    {
        return $this->hasOne(Store::class); // كل مستخدم (vendor) يمكنه امتلاك متجر واحد
    }

    public function orders()
    {
        return $this->hasMany(Order::class); // كل مستخدم (customer) يمكنه إنشاء عدة طلبات
    }
    public function reviews()
{
    return $this->hasMany(Review::class);
}

}

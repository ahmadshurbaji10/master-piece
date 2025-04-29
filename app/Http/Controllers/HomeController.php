<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // ✅ جلب آخر 6 منتجات حسب تاريخ الإنشاء
        $products = Product::latest()->take(6)->get();

        return view('home', compact('products'));
    }
}


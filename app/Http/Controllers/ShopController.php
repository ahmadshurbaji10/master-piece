<?php

namespace App\Http\Controllers;
 use App\Models\Product;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category'); // ✅ لتحميل التصنيف مع كل منتج

        // 🔍 فلترة حسب الاسم
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷️ فلترة حسب القسم (category_id)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // ↕️ ترتيب النتائج
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort === 'expiry_soon') {
            $query->orderBy('expiry_date', 'asc');
        } else {
            $query->latest(); // الافتراضي
        }

        $products = $query->get();
        $categories = Category::all(); // ✅ عشان نعرضها في الفلتر

        return view('shop', compact('products', 'categories'));
    }


    public function show($id)
{
    $product = Product::with('category', 'reviews.user')->findOrFail($id); // جلب المنتج مع التقييمات والمستخدمين
    
    return view('shop.show', compact('product'));
}
}

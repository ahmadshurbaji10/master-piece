<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض جميع المنتجات
    public function index(Request $request)
{
    $query = Product::with('store')->latest();

    // 🔍 فلترة بالاسم
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 🏬 فلترة حسب المتجر
    if ($request->filled('store_id')) {
        $query->where('store_id', $request->store_id);
    }

    // 📦 فلترة حسب حالة المخزون
    if ($request->stock_status === 'in') {
        $query->where('stock', '>', 0);
    } elseif ($request->stock_status === 'out') {
        $query->where('stock', '=', 0);
    }

    // ⏰ فلترة حسب تاريخ الانتهاء
    if ($request->filled('expiry_date')) {
        $query->whereDate('expiry_date', '<=', $request->expiry_date);
    }

    // 💵 فلترة حسب السعر من / إلى
    if ($request->filled('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }

    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    // ↕️ الترتيب حسب السعر أو الأحدث
    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
                $query->latest();
                break;
        }
    }

    $products = $query->get();
    $stores = \App\Models\Store::all();

    return view('admin.products.index', compact('products', 'stores'));
}



    // عرض صفحة إضافة منتج جديد
    public function create()
    {
        return view('admin.products.create');
    }

    // حفظ منتج جديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_id'    => 'required|exists:stores,id',
        ]);

        // معالجة رفع الصورة إذا تم رفعها
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'expiry_date' => $request->expiry_date,
            'image_url'   => $imagePath, // استخدام نفس عمود image_url لتخزين المسار
            'store_id'    => $request->store_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }



    // عرض صفحة تعديل منتج
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // تعديل بيانات المنتج
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric',
        'stock'       => 'required|integer|min:0',
        'expiry_date' => 'nullable|date',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ✅ دعم الصور فقط
    ]);

    $data = [
        'name'        => $request->name,
        'price'       => $request->price,
        'stock'       => $request->stock,
        'expiry_date' => $request->expiry_date,
    ];

    // ✅ التعامل مع رفع الصورة الجديدة
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $data['image_url'] = $imagePath;
    }

    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
}


    // حذف منتج
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function show(Product $product)
{
    return view('admin.products.show', compact('product'));
}

}

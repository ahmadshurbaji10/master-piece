<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // عرض منتجات البائع الحالي
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return back()->with('error', 'No store linked to this user.');
        }

        $products = Product::where('store_id', $store->id)->get();

        return view('vendor.products.index', compact('products'));
    }

    // عرض نموذج إنشاء منتج جديد
    public function create()
    {
        return view('vendor.products.create');
    }

    // حفظ المنتج الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'image'       => 'nullable|image|max:2048',
        ]);

        // رفع الصورة إن وجدت
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // إنشاء المنتج مع store_id ثابت
        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'expiry_date' => $request->expiry_date,
            'store_id'    => 3, // ← رقم المتجر الثابت
            'image_url'   => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
public function shop()
{
    $products = Product::with('discount')->get(); // 👈 تحميل الخصم مع المنتج
    return view('shop', compact('products'));
}


    // عرض نموذج تعديل منتج
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $store = auth()->user()->store;

        if (!$store || $product->store_id != $store->id) {
            abort(403);
        }

        return view('vendor.products.edit', compact('product'));
    }

    // تحديث المنتج
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $store = auth()->user()->store;

        if (!$store || $product->store_id != $store->id) {
            abort(403);
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'image_url'   => 'nullable|url',
            'expiry_date' => 'nullable|date',
            'stock'       => 'required|integer|min:0', // ✅ تحقق من الكمية بالتعديل
        ]);

        $product->update($request->only(['name', 'price', 'image_url', 'expiry_date', 'stock'])); // ✅ تحديث الكمية

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    // حذف المنتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $store = auth()->user()->store;

        if (!$store || $product->store_id != $store->id) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }


}

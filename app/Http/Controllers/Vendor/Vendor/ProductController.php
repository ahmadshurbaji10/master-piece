<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', auth()->id())->first();

        if (!$store) {
            return view('vendor.products.index', ['products' => collect()]);
        }

        $products = Product::where('store_id', $store->id)->latest()->get();

        return view('vendor.products.index', compact('products'));
    }

    public function create()
    {
        return view('vendor.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'expiry_date'  => 'nullable|date',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $store = Store::where('user_id', auth()->id())->first();

        if (!$store) {
            return redirect()->back()->with('error', 'Store not found for this vendor.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'expiry_date' => $request->expiry_date,
            'image_url'   => $imagePath,
            'store_id'    => $store->id,
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $this->authorizeProduct($product);

        return view('vendor.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'expiry_date'  => 'nullable|date',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }

            $product->image_url = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'         => $request->name,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'expiry_date'  => $request->expiry_date,
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }

    private function authorizeProduct(Product $product)
    {
        $store = Store::where('user_id', auth()->id())->first();

        if (!$store || $product->store_id !== $store->id) {
            abort(403, 'Unauthorized');
        }
    }
}

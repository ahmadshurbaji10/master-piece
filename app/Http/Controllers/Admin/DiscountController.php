<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(Request $request)
{
    $query = Discount::with('product')->latest();

    if ($request->filled('product_id')) {
        $query->where('product_id', $request->product_id);
    }

    $discounts = $query->get();

    return view('admin.discounts.index', compact('discounts'));
}


    public function create()
    {
        $products = Product::all();
        return view('admin.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'         => 'required|exists:products,id',
            'discount_percentage'=> 'required|numeric|min:1|max:100',
            'start_date'         => 'required|date',
            'end_date'           => 'required|date|after_or_equal:start_date',
        ]);

        Discount::create($request->all());

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        $products = Product::all();
        return view('admin.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'product_id'         => 'required|exists:products,id',
            'discount_percentage'=> 'required|numeric|min:1|max:100',
            'start_date'         => 'required|date',
            'end_date'           => 'required|date|after_or_equal:start_date',
        ]);

        $discount->update($request->all());

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully.');
    }
}

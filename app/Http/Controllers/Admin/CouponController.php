<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $coupons = Coupon::latest()->get();
    return view('admin.coupons.index', compact('coupons'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.coupons.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|string|unique:coupons,code',
        'discount_type' => 'required|in:fixed,percentage',
        'discount_amount' => 'required|numeric|min:0',
        'usage_limit' => 'required|integer|min:1',
        'expires_at' => 'nullable|date|after_or_equal:today',
    ]);

    \App\Models\Coupon::create($validated);

    return redirect()->route('coupons.index')->with('success', 'Coupon created successfully!');
}


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */public function edit($id)
{
    $coupon = \App\Models\Coupon::findOrFail($id);
    return view('admin.coupons.edit', compact('coupon'));
}

public function update(Request $request, $id)
{
    $coupon = \App\Models\Coupon::findOrFail($id);

    $validated = $request->validate([
        'code' => 'required|string|unique:coupons,code,' . $coupon->id,
        'discount_type' => 'required|in:fixed,percentage',
        'discount_amount' => 'required|numeric|min:0',
        'usage_limit' => 'required|integer|min:1',
        'expires_at' => 'nullable|date|after_or_equal:today',
    ]);

    $coupon->update($validated);

    return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}

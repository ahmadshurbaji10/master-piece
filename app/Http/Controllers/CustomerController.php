<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // ✅ Dashboard view
    public function dashboard()
    {
        $user = Auth::user();

        $orders = Order::with('items.product')->where('user_id', $user->id)->latest()->get();
        $products = Product::where('stock', '>', 0)->latest()->get();

        return view('customer.dashboard', compact('orders', 'products'));
    }

    // ✅ Update profile
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed', // new password is optional
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('customer.dashboard')->with('success', 'Profile updated successfully!');
}

    // ✅ Order product
    public function orderProduct(Product $product)
    {
        $user = Auth::user();

        if ($product->stock < 1) {
            return back()->with('error', 'Product is out of stock!');
        }

        $quantity = 1; // بإمكانك لاحقًا تعيينه من الفورم
        $total = $product->price * $quantity;

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'store_id' => $product->store_id,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // إضافة العناصر
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
        ]);

        // تقليل المخزون
        $product->decrement('stock', $quantity);

        return redirect()->route('customer.dashboard')->with('success', 'Product ordered successfully!');
    }

    // ✅ Show order details
    public function showOrder($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('customer.orders.show', compact('order'));
    }
}

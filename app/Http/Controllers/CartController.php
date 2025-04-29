<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // ✅ عرض السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }

    // ✅ إضافة منتج إلى السلة
    public function add(Request $request, Product $product)
{
    $cart = session()->get('cart', []);

    $cart[$product->id] = [
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => isset($cart[$product->id]) ? $cart[$product->id]['quantity'] + 1 : 1,
        'image_url' => $product->image_url,
    ];

    session()->put('cart', $cart);

    if ($request->ajax()) {
        // نحسب العدد الإجمالي ونرجعه
        $cartCount = collect($cart)->sum('quantity');

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
        ]);
    }

    return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة.');
}


    // ✅ حذف منتج من السلة
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة.');
    }

    // ✅ تحديث كمية منتج
    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return redirect()->back();
        }

        if ($request->action == 'increase') {
            $cart[$product->id]['quantity']++;
        } elseif ($request->action == 'decrease') {
            $cart[$product->id]['quantity']--;
            if ($cart[$product->id]['quantity'] <= 0) {
                unset($cart[$product->id]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'تم تحديث السلة.');
    }

    // ✅ صفحة الدفع
    public function checkout(Request $request)
{
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'السلة فارغة.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'payment_method' => 'required|in:cash,visa',
    ]);

    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $total,
        'status' => 'pending',
        'name' => $request->name,  // ⬅ خزن الاسم
        'address' => $request->address, // ⬅ خزن العنوان
        'payment_method' => $request->payment_method, // ⬅ خزن طريقة الدفع
    ]);

    foreach ($cart as $id => $item) {
        $product = Product::find($id);
        if (!$product) continue;

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('customer.dashboard')->with('success', 'تم تنفيذ الطلب بنجاح ✅');
}

public function addToCart(Request $request, $id)
{
    if (!auth()->check() || auth()->user()->role !== 'customer') {
        return redirect()->route('login')->with('error', 'يجب تسجيل الدخول كعميل لإضافة المنتجات إلى السلة.');
    }

    $product = Product::findOrFail($id);

    // الكود الطبيعي للإضافة للسلة مثلا
    $cart = session()->get('cart', []);
    $cart[$id] = [
        "name" => $product->name,
        "price" => $product->price,
        "quantity" => 1
    ];
    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'cartCount' => count($cart)
    ]);
}


}

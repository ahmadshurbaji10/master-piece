<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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

        $currentQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
        if ($currentQty >= $product->stock) {
            return redirect()->back()->with('error', 'Cannot add more than available stock');
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $currentQty + 1,
            'image_url' => $product->image_url,
            'stock' => $product->stock,
        ];

        session()->put('cart', $cart);

        if ($request->ajax()) {
            $cartCount = collect($cart)->sum('quantity');
            return response()->json([
                'success' => true,
                'cartCount' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'The product has been added to the cart.');
    }

    public function setQuantity(Request $request, $id)
    {
        $quantity = max(1, intval($request->quantity));
        $cart = session()->get('cart', []);
        $product = Product::find($id);

        if (!$product) return redirect()->back();

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', "Only {$product->stock} items available in stock.");
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['stock'] = $product->stock;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }




    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed from cart');
    }


    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return redirect()->back();
        }

        if ($request->action == 'increase') {
            if ($cart[$product->id]['quantity'] < $product->stock) {
                $cart[$product->id]['quantity']++;
            } else {
                return redirect()->back()->with('error', 'You reached the maximum stock available');
            }
        }


        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated');
    }




    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $coupon = \App\Models\Coupon::where('code', $request->coupon_code)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })->first();

        if (!$coupon || $coupon->usage_limit <= 0) {
            return back()->with('error', 'Invalid or expired coupon');
        }

        session(['applied_coupon' => $coupon->code]);
        return back()->with('success', 'Coupon applied successfully!');
    }

public function checkout(Request $request)
{
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'The cart is empty');
    }

    $payment = $request->payment_method;

    $rules = [
        'payment_method' => 'required|in:cash,visa',
        'coupon_code' => 'nullable|string'
    ];

    if ($payment === 'cash') {
        $rules['name'] = 'required|string|max:255';
        $rules['address'] = 'required|string|max:255';
    }

    if ($payment === 'visa') {
        $rules['card_name'] = 'required|string|max:255';
        $rules['card_number'] = 'required|digits:16';
        $rules['expiry_date'] = ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'];
        $rules['cvv'] = 'required|digits_between:3,4';
    }

    $request->validate($rules);

    foreach ($cart as $id => $item) {
        $product = Product::find($id);
        if (!$product) continue;

        if ($item['quantity'] > $product->stock) {
            return redirect()->route('cart.index')
                ->with('error', "Required quantity of product ({$product->name}) not available. Available Quantity: {$product->stock}.");
        }
    }

    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);


    $discountAmount = 0;
    if ($request->filled('coupon_code')) {
        $coupon = \App\Models\Coupon::where('code', $request->coupon_code)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })->first();

        if ($coupon) {
            if ($coupon->usage_limit > 0) {
                $discountAmount = $coupon->discount_type === 'fixed'
                    ? $coupon->discount_amount
                    : ($coupon->discount_amount / 100) * $total;

                $discountAmount = min($discountAmount, $total);
                $coupon->decrement('usage_limit');
            } else {
                return back()->with('error', 'Coupon usage limit exceeded');
            }
        } else {
            return back()->with('error', 'Invalid or expired coupon');
        }
    }

    $finalTotal = $total - $discountAmount;

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $finalTotal,
        'store_id' => 1,
        'status' => 'pending',
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

        $product->stock -= $item['quantity'];
        $product->save();
    }

    session()->forget('cart');

    // توليد الفاتورة
    $customerData = [
        'name' => $request->input('name') ?? $request->input('card_name') ?? 'N/A',
        'address' => $request->input('address') ?? 'Paid with Visa',
        'payment_method' => $payment ?? 'N/A',
    ];

    $pdf = Pdf::loadView('invoice', [
        'order' => $order,
        'customer' => $customerData,
    ]);

    $pdfPath = 'invoices/invoice_' . $order->id . '.pdf';
    Storage::disk('public')->put($pdfPath, $pdf->output());

    return redirect()->route('customer.dashboard')->with('success', 'The request was executed successfully ✅. <a href="' . asset('storage/' . $pdfPath) . '" target="_blank">View Invoice PDF</a>');
}







public function addToCart(Request $request, $id)
{
    if (!auth()->check() || auth()->user()->role !== 'customer') {
        return redirect()->route('login')->with('error', 'You must be logged in as a customer to add products to the cart.');
    }

    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    $currentQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

    if ($currentQty >= $product->stock) {
        return response()->json([
            'success' => false,
            'message' => 'Cannot add more than available stock.'
        ]);
    }

    $cart[$id] = [
        "name" => $product->name,
        "price" => $product->price,
        "quantity" => $currentQty + 1,
        "image_url" => $product->image_url,
        "stock" => $product->stock,
    ];

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'cartCount' => collect($cart)->sum('quantity'),
    ]);
}



}

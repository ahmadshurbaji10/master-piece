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

    return redirect()->back()->with('success', 'The product has been added to the cart.');
}

public function setQuantity(Request $request, $id)
{
    $quantity = max(1, intval($request->quantity)); // التأكد أنه >= 1
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $quantity;
        session()->put('cart', $cart);
    }

    return redirect()->back();
}

    // ✅ حذف منتج من السلة
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product removed from cart');
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

        return redirect()->back()->with('success', 'Cart updated');
    }

    // ✅ صفحة الدفع



public function checkout(Request $request)
{
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'The cart is empty');
    }

    $payment = $request->payment_method;

    $rules = [
        'payment_method' => 'required|in:cash,visa',
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

    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $total,
        'store_id' => 1, // أو حسب ما عندك
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

    // ✅ توليد الفاتورة مع تمرير البيانات يدويًا
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

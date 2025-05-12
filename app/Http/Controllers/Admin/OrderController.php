<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Order $order)
{
    $order->status = 'completed';
    $order->save();

    return back()->with('success', 'تم تحديث حالة الطلب إلى مكتمل ✅');
}
public function destroy(Order $order)
{
    // تأكد من صلاحيات المستخدم أولاً
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    // غير حالة الطلب إلى "ملغى" بدلاً من حذفه
    $order->update(['status' => 'canceled']);

    return redirect()->route('admin.orders.index')
        ->with('success', 'Order has been cancelled successfully');
}
}


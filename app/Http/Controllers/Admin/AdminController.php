<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order; // تأكد من وجود موديل الطلبات في مشروعك
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalProducts = Product::count();
        $outOfStock = Product::where('stock', 0)->count();
        $expiringSoon = Product::whereDate('expiry_date', '<=', now()->addDays(7))->count();

        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');

        // المنتجات المباعة (حسب order_items)
        $soldCount = OrderItem::sum('quantity');

        // المنتجات المتبقية (مجموع stock من جدول المنتجات)
        $remainingCount = Product::sum('stock');

        // نسبة مئوية
        $totalQuantity = $soldCount + $remainingCount;
        $soldPercentage = $totalQuantity > 0 ? round(($soldCount / $totalQuantity) * 100, 1) : 0;
        $remainingPercentage = 100 - $soldPercentage;

        return view('admin.dashboard', compact(
            'totalProducts',
            'outOfStock',
            'expiringSoon',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'soldPercentage',
            'remainingPercentage'
        ));
    }


    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }
}

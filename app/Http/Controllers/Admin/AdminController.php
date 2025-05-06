<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order; // تأكد من وجود موديل الطلبات في مشروعك
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    $ordersToday = Order::whereDate('created_at', Carbon::today())->count();

    // المنتجات المتبقية
    $remainingCount = Product::sum('stock');

    $totalQuantity = $soldCount + $remainingCount;
    $soldPercentage = $totalQuantity > 0 ? round(($soldCount / $totalQuantity) * 100, 1) : 0;
    $remainingPercentage = 100 - $soldPercentage;

    // ✅ المنتج الأكثر طلبًا
    $topOrderedProduct = OrderItem::select('product_id')
    ->selectRaw('SUM(quantity) as total_quantity')
    ->groupBy('product_id')
    ->orderByDesc('total_quantity')
    ->with('product')
    ->first();

$topProductName = 'N/A';
$topProductQuantity = 0;

if ($topOrderedProduct && $topOrderedProduct->product) {
    $topProductName = $topOrderedProduct->product->name;
    $topProductQuantity = $topOrderedProduct->total_quantity;
}


    return view('admin.dashboard', compact(
        'totalProducts',
        'outOfStock',
        'expiringSoon',
        'totalUsers',
        'totalOrders',
        'totalRevenue',
        'soldPercentage',
        'remainingPercentage',
        'ordersToday', // ✅ أضف هذا
        'topProductName',
        'topProductQuantity' // ✅ Add this

    ));
}



    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }
}

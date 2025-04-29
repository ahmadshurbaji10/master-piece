<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $store = Store::where('user_id', $user->id)->first();

        if (!$store) {
            return view('vendor.dashboard')->with([
                'productCount' => 0,
                'orderCount' => 0,
                'totalRevenue' => 0,
                'inStockCount' => 0,
                'expiringSoonCount' => 0,
                'soldPercentage' => 0,
                'remainingPercentage' => 0,
            ]);
        }

        $productCount = Product::where('store_id', $store->id)->count();
        $inStockCount = Product::where('store_id', $store->id)->where('stock', '>', 0)->count();
        $expiringSoonCount = Product::where('store_id', $store->id)
            ->whereDate('expiry_date', '<=', now()->addDays(7))
            ->count();

        $orderCount = Order::whereHas('items.product', function ($query) use ($store) {
            $query->where('store_id', $store->id);
        })->count();

        $totalRevenue = OrderItem::whereHas('product', function ($query) use ($store) {
            $query->where('store_id', $store->id);
        })->sum(\DB::raw('price * quantity'));

        $total = $productCount;
        $sold = max(0, $total - $inStockCount);
        $soldPercentage = $total > 0 ? round(($sold / $total) * 100, 1) : 0;
        $remainingPercentage = $total > 0 ? round(($inStockCount / $total) * 100, 1) : 0;

        return view('vendor.dashboard', compact(
            'productCount',
            'orderCount',
            'totalRevenue',
            'inStockCount',
            'expiringSoonCount',
            'soldPercentage',
            'remainingPercentage'
        ));
    }

    public function account()
    {
        $user = auth()->user();
        return view('vendor.account', compact('user'));
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only('name', 'email', 'phone'));

        return redirect()->route('vendor.account')->with('success', 'Account updated successfully.');
    }
}

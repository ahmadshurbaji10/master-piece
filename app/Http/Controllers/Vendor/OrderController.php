<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // لاحقاً بنضيف من هنا فلترة حسب المتجر
        return view('vendor.orders.index');
    }
}


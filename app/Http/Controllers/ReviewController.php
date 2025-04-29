<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
{
    $request->validate([

        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|string|max:1000',
    ]);

    $product->reviews()->create([
        'user_id' => auth()->id(),
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}


}

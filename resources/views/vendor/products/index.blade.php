@extends('layouts.vendor-sidebar')

@section('title', '🛍️ My Products')
@section('page_title', 'My Products')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-extrabold text-gray-800">Welcome, {{ auth()->user()->name }} 👋</h2>
    <a href="{{ route('vendor.products.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
        ➕ Add Product
    </a>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-2xl font-bold text-gray-700 mb-6">Your Products:</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
            <div class="bg-gray-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-lg p-4 transition">
                @if($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md mb-4">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400 rounded-md mb-4">
                        No Image
                    </div>
                @endif

                <h4 class="font-bold text-lg text-gray-800 mb-1 truncate">{{ $product->name }}</h4>
                <p class="text-green-600 font-semibold text-md mb-1">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-600 mb-1">Stock: <span class="font-bold">{{ $product->stock }}</span></p>
                <p class="text-sm text-gray-500">Expires: {{ $product->expiry_date }}</p>

                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('vendor.products.edit', $product->id) }}" class="text-blue-600 font-semibold hover:underline">✏️ Edit</a>

                    <form method="POST" action="{{ route('vendor.products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 font-semibold hover:underline">🗑️ Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600 col-span-full text-center text-lg">You don't have any products yet.</p>
        @endforelse
    </div>
</div>

@endsection

@extends('layouts.admin')

@section('title', 'Admin | Manage Products')
@section('page_title', 'Manage Products')

@section('content')

<!-- 🔍 Filter Section -->
<div class="bg-white shadow-md rounded-lg p-6 mb-8">
    <form method="GET" action="{{ route('admin.products.index') }}">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <div>
                <label for="store_id" class="block text-gray-700 font-semibold mb-1">Store</label>
                <select name="store_id" id="store_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:border-green-400">
                    <option value="">All Stores</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}" {{ request('store_id') == $store->id ? 'selected' : '' }}>
                            {{ $store->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="stock_status" class="block text-gray-700 font-semibold mb-1">Stock Status</label>
                <select name="stock_status" id="stock_status" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:border-green-400">
                    <option value="">All</option>
                    <option value="in" {{ request('stock_status') == 'in' ? 'selected' : '' }}>In Stock</option>
                    <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>

            <div>
                <label for="expiry_date" class="block text-gray-700 font-semibold mb-1">Expiry Before</label>
                <input type="date" name="expiry_date" value="{{ request('expiry_date') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:border-green-400">
            </div>

            <div>
                <label for="price_min" class="block text-gray-700 font-semibold mb-1">Price From</label>
                <input type="number" step="0.01" name="price_min" value="{{ request('price_min') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:border-green-400">
            </div>

            <div>
                <label for="price_max" class="block text-gray-700 font-semibold mb-1">Price To</label>
                <input type="number" step="0.01" name="price_max" value="{{ request('price_max') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-400 focus:border-green-400">
            </div>
        </div>

        <div class="flex justify-end mt-6 space-x-4">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                ❌ Clear
            </a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700">
                🔍 Filter
            </button>
        </div>
    </form>
</div>

<!-- 📦 Products Table Section -->
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">All Products</h3>
        <a href="{{ route('admin.products.create') }}" class="px-5 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
            ➕ Add Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-green-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border">#</th>
                    <th class="px-4 py-3 border">Product Name</th>
                    <th class="px-4 py-3 border">Image</th>
                    <th class="px-4 py-3 border">Store</th>
                    <th class="px-4 py-3 border">Price</th>
                    <th class="px-4 py-3 border">Stock</th>
                    <th class="px-4 py-3 border">Expiry Date</th>
                    <th class="px-4 py-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border">{{ $product->name }}</td>
                        <td class="px-4 py-3 border text-center">
                            @if($product->image_url)
                                <img src="{{ asset('storage/' . $product->image_url) }}" class="w-16 h-16 object-cover rounded mx-auto" alt="{{ $product->name }}">
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border">{{ $product->store->name ?? '—' }}</td>
                        <td class="px-4 py-3 border text-green-700 font-semibold">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3 border text-center">{{ $product->stock }}</td>
                        <td class="px-4 py-3 border text-center">{{ $product->expiry_date }}</td>
                        <td class="px-4 py-3 border text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                                <a href="{{ route('admin.products.show', $product->id) }}" class="text-green-600 hover:underline text-sm">View</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

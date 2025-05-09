@extends('layouts.admin')

@section('title', 'Admin | Manage Products')
@section('page_title', 'Manage Products')

@section('content')

<!-- 🔍 Filter Section -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('admin.products.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
        <!-- Stock Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Stock Status</label>
            <select name="stock_status" class="w-full p-2 rounded-md border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500">
                <option value="">All</option>
                <option value="in">In Stock</option>
                <option value="out">Out of Stock</option>
            </select>
        </div>

        <!-- Expiry Before -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Before</label>
            <input type="date" name="expiry_date" class="w-full p-2 rounded-md border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500">
        </div>

        <!-- Price From -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Price From</label>
            <input type="number" step="0.01" name="price_from" class="w-full p-2 rounded-md border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500">
        </div>

        <!-- Price To -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Price To</label>
            <input type="number" step="0.01" name="price_to" class="w-full p-2 rounded-md border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500">
        </div>

        <!-- Filter Button -->
        <div class="flex items-end h-full">
            <button type="submit" class="w-full h-10 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                Filter
            </button>
        </div>
    </form>
</div>


<!-- 📦 Products Table Section -->
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Allow Points</h3>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
            ➕ Add Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Product Name</th>
                    <th class="px-4 py-3 text-left">Image</th>
                    <th class="px-4 py-3 text-left">Store</th>
                    <th class="px-4 py-3 text-left">Price</th>
                    <th class="px-4 py-3 text-left">Stock</th>
                    <th class="px-4 py-3 text-left">Expiry Date</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $product->name }}</td>
                        <td class="px-4 py-3">
                            @if($product->image_url)
                                <img src="{{ asset('storage/' . $product->image_url) }}" class="w-10 h-10 object-cover rounded" alt="{{ $product->name }}">
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">Default Store</td>
                        <td class="px-4 py-3 text-green-700 font-semibold">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3">{{ $product->expiry_date }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium px-2 py-1 bg-blue-50 rounded hover:bg-blue-100">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium px-2 py-1 bg-red-50 rounded hover:bg-red-100">Delete</button>
                                </form>
                                <a href="{{ route('admin.products.show', $product->id) }}" class="text-green-600 hover:text-green-800 text-sm font-medium px-2 py-1 bg-green-50 rounded hover:bg-green-100">View</a>
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

@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        ✏️ Edit Product
    </h2>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div>
            <label for="name" class="block font-semibold text-gray-700 mb-1">📝 Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        {{-- Price & Stock --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="price" class="block font-semibold text-gray-700 mb-1">💰 Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
            <div>
                <label for="stock" class="block font-semibold text-gray-700 mb-1">📦 Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
        </div>

        {{-- Expiry Date --}}
        <div>
            <label for="expiry_date" class="block font-semibold text-gray-700 mb-1">📅 Expiry Date</label>
            <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $product->expiry_date) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none">
        </div>

        {{-- Image Upload --}}
        <div>
            <label for="image" class="block font-semibold text-gray-700 mb-1">🖼️ Upload New Image</label>
            <input type="file" name="image" id="image"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-green-100 file:text-green-700
                hover:file:bg-green-200"/>

            @if($product->image_url)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image"
                         class="w-28 h-28 object-cover border rounded-md shadow-sm">
                </div>
            @endif
        </div>

        {{-- Submit --}}
        <div class="flex justify-end pt-4 space-x-4">
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-red-500 transition">Cancel</a>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-md transition">
                💾 Update Product
            </button>
        </div>
    </form>
</div>
@endsection

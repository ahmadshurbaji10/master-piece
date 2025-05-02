@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-plus-circle text-green-500 mr-2"></i> Add New Product
    </h2>
</div>

<div class="bg-white shadow-lg rounded-xl p-8">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Product Name --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">📝 Product Name</label>
            <input type="text" name="name" placeholder="Enter product name"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   required>
        </div>

        {{-- Price & Stock --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold text-gray-700 mb-2">💰 Price ($)</label>
                <input type="number" name="price" step="0.01" placeholder="0.00"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       required>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">📦 Stock</label>
                <input type="number" name="stock" placeholder="Available quantity"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       required>
            </div>
        </div>

        {{-- Expiry Date --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">📅 Expiry Date</label>
            <input type="date" name="expiry_date"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>

        {{-- Product Image --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">🖼️ Product Image</label>
            <input type="file" name="image" accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0
                   file:text-sm file:font-semibold
                   file:bg-green-100 file:text-green-700
                   hover:file:bg-green-200"/>
        </div>

        {{-- Store Selector --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">🏪 Select Store</label>
            <select name="store_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    required>
                <option value="">-- Select Store --</option>
                @foreach(App\Models\Store::all() as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end pt-4 space-x-4">
            <a href="{{ route('admin.products.index') }}"
               class="px-4 py-2 text-sm text-gray-600 hover:text-red-600 transition duration-150">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2 text-sm font-semibold text-white bg-green-600 rounded-md hover:bg-green-700 transition duration-150">
                Save Product
            </button>
        </div>
    </form>
</div>
@endsection

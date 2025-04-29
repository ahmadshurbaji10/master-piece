<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Product
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-gray-700 mb-1">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label for="price" class="block font-medium text-gray-700 mb-1">Price</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Stock --}}
                    <div class="mb-4">
                        <label for="stock" class="block font-medium text-gray-700 mb-1">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Image upload --}}
                    <div class="mb-4">
                        <label for="image" class="block font-medium text-gray-700 mb-1">Upload Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                        {{-- Show existing image --}}
                        @if($product->image_url)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" class="w-24 h-24 object-cover border rounded">
                            </div>
                        @endif
                    </div>

                    {{-- Expiry Date --}}
                    <div class="mb-4">
                        <label for="expiry_date" class="block font-medium text-gray-700 mb-1">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $product->expiry_date) }}"
                            class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            💾 Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

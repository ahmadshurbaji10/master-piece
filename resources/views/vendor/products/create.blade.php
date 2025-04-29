<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Add New Product
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                {{-- ✅ عرض الأخطاء إن وجدت --}}
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                            <strong>Whoops!</strong> Please fix the following issues:
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Product Name</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Price ($)</label>
                        <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" value="{{ old('price') }}" required>
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Stock</label>
                        <input type="number" name="stock" class="w-full border rounded px-3 py-2" value="{{ old('stock') }}" required>
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Expiry Date</label>
                        <input type="date" name="expiry_date" class="w-full border rounded px-3 py-2" value="{{ old('expiry_date') }}">
                    </div>

                    <!-- Product Image -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Product Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('vendor.products.index') }}" class="mr-4 text-gray-600 hover:underline">Cancel</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

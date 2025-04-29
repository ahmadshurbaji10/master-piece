<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Product Details
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    {{-- صورة المنتج --}}
                    <div class="flex-shrink-0">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}"
                                 alt="{{ $product->name }}"
                                 class="w-48 h-48 object-cover rounded shadow">
                        @else
                            <div class="w-48 h-48 bg-gray-200 flex items-center justify-center rounded text-gray-500">
                                No Image
                            </div>
                        @endif
                    </div>

                    {{-- تفاصيل المنتج --}}
                    <div class="flex-1 space-y-3">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h3>

                        <p><strong>Store:</strong> {{ $product->store->name ?? '—' }}</p>
                        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                        <p><strong>Stock:</strong> {{ $product->stock }}</p>
                        <p><strong>Expiry Date:</strong> {{ $product->expiry_date ?? '—' }}</p>

                        <div class="mt-6">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                ✏️ Edit
                            </a>
                            <a href="{{ route('admin.products.index') }}"
                               class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition ml-2">
                                ← Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

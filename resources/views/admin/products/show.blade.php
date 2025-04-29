<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📄 Product Details
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <h3 class="text-2xl font-bold mb-4">{{ $product->name }}</h3>

            <p class="mb-2"><strong>Price:</strong> ${{ $product->price }}</p>
            <p class="mb-2"><strong>Stock:</strong> {{ $product->stock }}</p>
            <p class="mb-2"><strong>Expiry Date:</strong> {{ $product->expiry_date }}</p>
            <p class="mb-2"><strong>Store:</strong> {{ $product->store->name ?? '—' }}</p>

            @if($product->image_url)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                         class="w-48 h-auto rounded shadow-md">
                </div>
            @else
                <p class="text-sm text-gray-500 italic mt-4">No image available.</p>
            @endif
        </div>
    </div>
</x-app-layout>

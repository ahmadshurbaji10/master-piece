@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        📄 Product Details
    </h2>
</div>

<div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

        {{-- Textual Details --}}
        <div>
            <h3 class="text-2xl font-bold text-green-700 mb-4">{{ $product->name }}</h3>

            <ul class="space-y-2 text-gray-700">
                <li><strong>💰 Price:</strong> ${{ $product->price }}</li>
                <li><strong>📦 Stock:</strong> {{ $product->stock }}</li>
                <li><strong>📅 Expiry Date:</strong> {{ $product->expiry_date }}</li>
                <li><strong>🏬 Store:</strong> {{ $product->store->name ?? '—' }}</li>
            </ul>
        </div>

        {{-- Product Image --}}
        <div class="flex justify-center md:justify-end">
            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}"
                     alt="{{ $product->name }}"
                     class="rounded-md shadow-md max-h-56 w-auto border border-gray-200">
            @else
                <div class="text-gray-400 italic">No image available.</div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin') {{-- أو حسب اسم الـ layout الخاص بك --}}

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h4 class="mb-0">🛒 Your Cart</h4>
        </div>
        <div class="card-body">
            @forelse($cartItems as $item)
                <div class="card mb-3 border rounded shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $item->product->image_url) }}" width="80" class="me-3 rounded border">
                            <div>
                                <h5 class="mb-1">{{ $item->product->name }}</h5>
                                <p class="mb-0">Price: <strong>${{ number_format($item->product->price, 2) }}</strong></p>
                                <p class="mb-0">Quantity: <strong>{{ $item->quantity }}</strong></p>
                            </div>
                        </div>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                🗑 Remove
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    Your cart is empty.
                </div>
            @endforelse

            @if($cartItems->count())
                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                    <h5 class="fw-bold">Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</h5>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            ✅ Proceed to Checkout
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

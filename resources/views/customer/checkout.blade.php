@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">💳 Checkout</h2>

    @if(!empty($cart))
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <ul class="list-group mb-4">
                            @foreach($cart as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item['image_url']) }}" width="60" height="60" class="me-3 rounded border" style="object-fit: contain;">
                                        <div>
                                            <h6 class="mb-0">{{ $item['name'] }}</h6>
                                            <small class="text-muted">${{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}</small>
                                        </div>
                                    </div>
                                    <span class="fw-bold text-success">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="text-end mb-4">
                            <h5>Total: <span class="text-primary">${{ number_format($total, 2) }}</span></h5>
                        </div>

                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 py-2">
                                ✅ Confirm & Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            ⚠️ Your cart is empty.
        </div>
    @endif
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <h2 class="mb-3">Order #{{ $order->id }}</h2>
    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Payment:</strong> {{ $order->payment_method }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>

    <hr>
    <h4>Items</h4>
    <table class="table table-striped bg-white shadow-sm">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

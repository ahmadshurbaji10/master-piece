{{-- resources/views/customer/orders/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">📦 Order #{{ $order->id }} Details</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Status:</strong>
                @if($order->status === 'completed')
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-warning text-dark">Pending</span>
                @endif
            </p>
            @php
            $calculatedTotal = $order->items->sum(function($item) {
                return $item->price * $item->quantity;
            });
        @endphp

        <p><strong>Total Price:</strong> ${{ number_format($calculatedTotal, 2) }}</p>
                    <p><strong>Created At:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
        </div>
    </div>

    <h4>🛒 Ordered Items</h4>
    <div class="row">
        @foreach($order->items as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $item->product->image_url) }}" class="card-img-top p-2" style="height: 200px; object-fit: contain; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->product->name }}</h5>
                        <p class="mb-1 text-muted">💵 <strong>Price:</strong> ${{ number_format($item->product->price, 2) }}</p>
                        <p class="mb-0 text-muted">🔢 <strong>Quantity:</strong> {{ $item->quantity }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
</div>
</body>
</html>

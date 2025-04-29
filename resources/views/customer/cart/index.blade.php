<h3>🛒 Your Cart</h3>
@forelse($cartItems as $item)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5>{{ $item->product->name }}</h5>
                <p>Quantity: {{ $item->quantity }}</p>
                <p>Price: ${{ $item->product->price }}</p>
            </div>
            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Remove</button>
            </form>
        </div>
    </div>
@empty
    <p>Your cart is empty.</p>
@endforelse

@if($cartItems->count())
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button class="btn btn-success">Proceed to Checkout</button>
    </form>
@endif

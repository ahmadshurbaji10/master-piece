<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop - Vegefoods</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('navbar')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 d-flex">
                    <div class="product shadow-sm rounded p-3 mb-4 w-100">
                        <a href="{{ route('shop.show', $product->id) }}" class="img-prod d-block">
                            <img class="img-fluid" src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" style="height: 250px; object-fit: contain;">
                        </a>
                        <div class="text text-center mt-3">
                            <h5 class="mb-1">{{ $product->name }}</h5>

                            @if ($product->discount)
                                <p class="mb-1">
                                    <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-success fw-bold">${{ number_format($product->final_price, 2) }}</span>
                                </p>
                                <p class="text-danger small">Discount: {{ $product->discount->percentage }}%</p>
                            @else
                                <p class="text-success fw-bold mb-2">${{ number_format($product->price, 2) }}</p>
                            @endif

                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-outline-success btn-sm"> View Details</a>

                                @auth
                                    @if(auth()->user()->role === 'customer')
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm"> Add to Cart</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center w-100">No products available.</p>
            @endforelse
        </div>
    </div>
</section>

@include('footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - Vegefoods</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ✅ Google Fonts + CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="goto-here">

@include('navbar')

<section class="ftco-section">
    <div class="container">
        <div class="row">

            <!-- ✅ Product Image -->
            <div class="col-md-6 mb-4">
                <img src="{{ asset('storage/' . $product->image_url) }}" class="img-fluid border p-2 rounded" style="max-height: 400px; object-fit: contain;" alt="{{ $product->name }}">
            </div>

            <!-- ✅ Product Details -->
            <div class="col-md-6">
                <h2 class="mb-2">{{ $product->name }}</h2>

                @if($product->category)
                    <p class="text-muted mb-1">Category: {{ $product->category->name }}</p>
                @endif

                <p class="text-success h5 fw-bold">Price: ${{ number_format($product->price, 2) }}</p>
                <p class="text-muted">Available Stock: {{ $product->stock }}</p>

                @auth
                    @if(auth()->user()->role === 'customer')
                        <!-- ✅ Add to Cart Form -->
                        <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-success" id="add-to-cart-button">
                                Add to Cart
                            </button>
                        </form>

                        <!-- ✅ Submit Review Form -->
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mt-5">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1 to 5)</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">Select</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Review</label>
                                <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    @endif
                @endauth

                @guest
                    <div class="alert alert-info mt-4">
                        <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a> to write a review or add to cart.
                    </div>
                @endguest

                <!-- ✅ Show Reviews -->
                <div class="mt-5">
                    <h4>Reviews:</h4>
                    @forelse($product->reviews as $review)
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $review->user->name }}</strong>
                                <span class="text-warning fw-bold">★ {{ $review->rating }}/5</span>
                            </div>
                            <p class="mb-2 mt-1">{{ $review->comment }}</p>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="text-muted">No reviews yet. Be the first to write one!</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</section>

@include('footer')

<!-- ✅ JS Files -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<!-- ✅ SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ AJAX Add to Cart -->
<script>
$(document).ready(function() {
    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart!',
                    showConfirmButton: false,
                    timer: 1500
                });

                // ✅ تحديث رقم السلة
                if (response.cartCount !== undefined) {
                    $('#cart-count').text(response.cartCount);
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });
    });
});
</script>

</body>
</html>

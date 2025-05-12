<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - Vegefoods</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts + CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Star Rating CSS -->
    <style>
        .star-rating {
            direction: rtl;
            font-size: 1.5rem;
            unicode-bidi: bidi-override;
            display: inline-flex;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ccc;
            cursor: pointer;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
    </style>
</head>

<body class="goto-here">

    @include('navbar')

<section class="ftco-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row bg-white rounded shadow-sm p-4 align-items-start">

            <!-- ✅ Product Image -->
            <div class="col-md-5 text-center">
                <div class="border rounded p-3 bg-white" style="height: 100%; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('storage/' . $product->image_url) }}" class="img-fluid" style="max-height: 320px; object-fit: contain;" alt="{{ $product->name }}">
                </div>
            </div>

            <!-- ✅ Product Details -->
            <div class="col-md-7">
                <h3 class="fw-bold">{{ $product->name }}</h3>

                @if($product->category)
                    <p class="text-muted small">Category: {{ $product->category->name }}</p>
                @endif

                <h4 class="text-success fw-bold mb-2">Price: ${{ number_format($product->price, 2) }}</h4>
                <p class="text-success fw-bold mb-1">${{ number_format($product->price, 2) }}</p>
                @if($product->stock > 0)
    <p class="text-muted mb-2">🧮 Remaining: <strong>{{ $product->stock }}</strong> item{{ $product->stock > 1 ? 's' : '' }}</p>
@else
    <p class="text-danger fw-bold">Out of stock</p>
@endif

@if($product->expiry_date)
    @php
        $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($product->expiry_date), false);
    @endphp
    <p class="text-muted small mb-2">
        @if ($daysLeft > 0)
            ⏳ {{ $daysLeft }} day{{ $daysLeft > 1 ? 's' : '' }} left
        @elseif ($daysLeft == 0)
            ⚠️ Expires today!
        @else
            ❌ Expired {{ abs($daysLeft) }} day{{ abs($daysLeft) > 1 ? 's' : '' }} ago
        @endif
    </p>
@endif


                @auth
                    @if(auth()->user()->role === 'customer')
                        <!-- Add to Cart -->
                        <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="btn btn-success px-4">🛒 Add to Cart</button>
                        </form>

                        <!-- Review Form -->
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="border-top pt-4">
                            @csrf
                            <h5 class="mb-3">Rate this product</h5>

                            <div class="mb-3">
                                <div class="star-rating">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                        <label for="star{{ $i }}">★</label>
                                    @endfor
                                </div>
                            </div>

                            <div class="mb-3">
                                <textarea name="comment" rows="3" class="form-control" placeholder="Write your review..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    @endif
                @endauth

                @guest
                    <div class="alert alert-info mt-4">
                        <p>
                            <span>To write a review or add to cart, please </span>
                            <a href="javascript:void(0);" onclick="openLoginModal()" class="fw-bold text-primary text-decoration-underline">Login</a> or
                            <a href="javascript:void(0);" onclick="openRegisterModal()" class="fw-bold text-primary text-decoration-underline">Register</a>.

                        </p>
                    </div>
                @endguest
            </div>
        </div>

        <!-- ✅ Reviews Section -->
        <div class="row mt-5">
            <div class="col-md-10 offset-md-1">
                <h4 class="fw-bold mb-3">📝 Customer Reviews</h4>

                @forelse($product->reviews->sortByDesc('created_at')->take(5) as $review)
                <div class="bg-white border rounded p-3 mb-3 shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <strong>{{ $review->user->name }}</strong>
                            <span class="text-warning">★ {{ $review->rating }}/5</span>
                        </div>
                        <p class="mb-1">{{ $review->comment }}</p>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p class="text-muted">No reviews yet. Be the first to write one!</p>
                @endforelse
            </div>
        </div>
    </div>
</section>


<!-- Login Modal -->
<div id="loginModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 40px 30px; border-radius: 12px; max-width: 400px; width: 100%; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin: auto;">
        <button onclick="closeLoginModal()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 20px;">&times;</button>
        <h2 class="mb-4 text-center" style="color: #66bb6a; font-weight: 700; font-size: 28px;">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required placeholder="Enter your email">
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter your password">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success rounded-pill px-4 py-2">Login</button>
            </div>
        </form>
    </div>
</div>

@include('footer')

<!-- JS Files -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- AJAX Add to Cart -->
<script>
$(document).ready(function() {
    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({ icon: 'success', title: 'Added to Cart!', showConfirmButton: false, timer: 1500 });
                if (response.cartCount !== undefined) {
                    $('#cart-count').text(response.cartCount);
                }
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' });
            }
        });
    });
});

function openLoginModal() {
    document.getElementById("loginModal").style.display = "flex";
}
function closeLoginModal() {
    document.getElementById("loginModal").style.display = "none";
}
</script>

</body>
</html>

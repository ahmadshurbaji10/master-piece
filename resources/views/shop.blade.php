<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop - FreshSaver</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>

.out-of-stock {
    opacity: 0.6;
    pointer-events: none;
    position: relative;
}
.out-of-stock::after {
    content: 'Out of stock';
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(220, 53, 69, 0.95);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    font-size: 14px;
}

        /* Product card styles */
        .product-card {
            transition: all 0.3s;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-img-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            padding: 1rem;
        }
        .product-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        /* Filter section styles */

.filter-section {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
.filter-header {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 0.5rem;
    margin-bottom: 1.5rem;
    color: #82ae46;
}
.filter-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: #495057;
}
.filter-input {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    border: 1px solid #ced4da;
}
.filter-input:focus {
    border-color: #82ae46;
    box-shadow: 0 0 0 0.25rem rgba(130, 174, 70, 0.25);
}
.btn-apply {
    background-color: #82ae46;
    color: white;
    border-radius: 8px;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    border: none;
    transition: all 0.3s;
}
.btn-apply:hover {
    background-color: #6c9440;
    transform: translateY(-2px);
}


    </style>
</head>
<body class="goto-here">

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">FreshSaver</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/home') ? 'active' : '' }}">
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            👤 Hi, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('cart.index') }}">🛒 Cart</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}#orders">🧾 Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">👤 Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="javascript:void(0);" onclick="openLoginModal()" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" onclick="openRegisterModal()" class="nav-link">Register</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        <i class="icon-shopping_cart"></i>
                        <span> (<span id="cart-count">{{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}</span>)</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Filter section -->
<section class="py-4">
    <div class="container">
        <div class="filter-section">
            <h4 class="filter-header"><i class="fas fa-filter me-2"></i> Filter Products</h4>
            <form method="GET" action="{{ route('shop') }}">
                <div class="row g-3 align-items-end">
                    <!-- حقل البحث -->
                    <div class="col-md-3">
                        <label class="filter-label">Search by name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="e.g. Juice" value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- التصنيفات -->
                    <div class="col-md-2">
                        <label class="filter-label">Category</label>
                        <select name="category" class="form-select shadow-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- الترتيب -->
                    <div class="col-md-2">
                        <label class="filter-label">Sort By</label>
                        <select name="sort" class="form-select shadow-sm">
                            <option value="">Default</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="expiry_soon" {{ request('sort') == 'expiry_soon' ? 'selected' : '' }}>Expiry Soon</option>
                        </select>
                    </div>

                    <!-- تاريخ الانتهاء -->
                    <div class="col-md-2">
                        <label class="filter-label">Expiring in (days)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-clock"></i></span>
                            <input type="number" name="expires_in" class="form-control border-start-0" placeholder="Days" min="1" value="{{ request('expires_in') }}">
                        </div>
                    </div>

                    <!-- زر التطبيق -->
                    <div class="col-md-2">
                        <label class="filter-label" style="visibility: hidden;">Apply</label>
                        <button type="submit" class="btn btn-success w-100 shadow-sm">
                            <i class="fas fa-filter me-1"></i> Apply
                        </button>
                    </div>

                    <!-- زر الإعادة -->
                    <div class="col-md-1">
                        <label class="filter-label" style="visibility: hidden;">Reset</label>
                        <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 shadow-sm" title="Reset filters">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Products section -->
<section class="pb-5">
    <div class="container">
        <div class="row">
            @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100 shadow-sm {{ $product->stock == 0 ? 'out-of-stock' : '' }}">

                        <div class="product-img-container">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-success fw-bold mb-1">${{ number_format($product->price, 2) }}</p>

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

                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-outline-success btn-sm" style="border-radius: 8px; min-width: 100px;">View Details</a>

                                @auth
                                    @if(auth()->user()->role === 'customer')
                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success btn-sm" style="border-radius: 8px; min-width: 100px;">Add to Cart</button>
                                            </form>
                                        @endif
                                    @endif
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://via.placeholder.com/300x200?text=No+Products" alt="No products" class="img-fluid mb-4" style="max-width: 300px;">
                    <h4 class="mb-3">No products found</h4>
                    <p class="text-muted">Try adjusting your search or filter to find what you're looking for.</p>
                    <a href="{{ route('shop') }}" class="btn btn-success">
                        <i class="fas fa-undo me-2"></i> Reset Filters
                    </a>
                </div>
            @endforelse
        </div>

        @if($products->hasPages())
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Footer -->
<footer class="py-5 text-white" style="background-color: #82ae46;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <h5 class="fw-bold">FreshSaver</h5>
                <p class="small">We help you save money on quality products close to expiry date.</p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1"><i class="fas fa-chevron-right me-2"></i><a href="/shop" class="text-white text-decoration-none">Shop</a></li>
                    <li class="mb-1"><i class="fas fa-chevron-right me-2"></i><a href="/about" class="text-white text-decoration-none">About</a></li>
                    <li class="mb-1"><i class="fas fa-chevron-right me-2"></i><a href="/contact" class="text-white text-decoration-none">Contact</a></li>
                    <li><i class="fas fa-chevron-right me-2"></i><a href="/dashboard" class="text-white text-decoration-none">Dashboard</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Contact Us</h6>
                <p class="small mb-1"><i class="fas fa-map-marker-alt me-2"></i>Amman, Jordan</p>
                <p class="small mb-1"><i class="fas fa-phone me-2"></i>+962 7 9999 9999</p>
                <p class="small"><i class="fas fa-envelope me-2"></i>info@freshsaver.com</p>
            </div>
        </div>

        <hr class="border-light">

        <div class="text-center small">
            &copy; {{ date('Y') }} <strong>FreshSaver</strong>. All rights reserved.
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>








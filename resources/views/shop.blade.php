<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop - Vegefoods</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="goto-here">

    {{-- ✅ Navbar --}}
    @include('navbar')

    {{-- ✅ فلترة و بحث --}}
    <section class="ftco-section pt-5 pb-0">
        <div class="container mb-4">
            <form method="GET" action="{{ route('shop') }}" class="d-flex justify-content-center gap-2 flex-wrap">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control w-25" placeholder="Search by name">

                <select name="category" class="form-control w-25">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <select name="sort" class="form-control w-25">
                    <option value="">Sort by</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="expiry_soon" {{ request('sort') == 'expiry_soon' ? 'selected' : '' }}>Expiry Soon</option>
                </select>

                <button class="btn btn-outline-success px-4 py-2">Filter</button>
            </form>
        </div>
    </section>

    {{-- ✅ عرض المنتجات --}}
    <section class="ftco-section pt-0">
        <div class="container">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate mb-4">
                        <div class="product h-100 d-flex flex-column">
                            <a href="{{ route('shop.show', $product->id) }}" class="img-prod">
                                <img class="img-fluid" style="width: 100%; height: 200px; object-fit: contain;" src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 px-3 text-center flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h3><a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a></h3>
                                    @if($product->category)
                                        <p class="text-muted small">{{ $product->category->name }}</p>
                                    @endif
                                    <p class="price text-primary fw-bold mb-2">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-outline-success btn-sm mt-2">👁️ View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-12">No products found.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ✅ Footer --}}
    @include('footer')

    {{-- ✅ JS Files --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>

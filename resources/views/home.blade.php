<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

  </head>
  <body class="goto-here">

          <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">FreshSaver</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ url('/shop') }}">Shop</a>
                    </div>
                </li>

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
                            {{-- <li><a class="dropdown-item" href="{{ route('cart.checkoutPage') }}">💳 Checkout</a></li> --}}
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

                <li class="nav-item cta cta-colored">
                    <a href="#" class="nav-link">
                        <span class="icon-shopping_cart"></span> [0]
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image: url(images/OIP.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">


	          </div>
	        </div>
	      </div>

	      <div class="slider-item" style="background-image: url(images/Super-Markets-Wholesale-230923.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

	            <div class="col-sm-12 ftco-animate text-center">
	              <h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
	              <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
	              <p><a href="#" class="btn btn-primary">View Details</a></p>
	            </div>

	          </div>
	        </div>
	      </div>
	    </div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-shipped"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Free Shipping</h3>
                <span>On order over $100</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-diet"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Always Fresh</h3>
                <span>Product well package</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-award"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Superior Quality</h3>
                <span>Quality Products</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services mb-md-0 mb-4">
              <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Support</h3>
                <span>24/7 Support</span>
              </div>
            </div>
          </div>
        </div>
			</div>
		</section>



     <!-- ✅ CATEGORIES SECTION -->
<section class="ftco-section bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-success">PRODUCT CATEGORIES</h2>
            <p class="text-muted">Browse items by type to find what you need</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @php
                $categories = \App\Models\Category::limit(4)->get();
                $imageMap = [
                    'grains' => 'images/categories/th.jpeg',
                    'oils' => 'images/categories/Zjpg.jpg',
                    'canned' => 'images/categories/MO.jpeg',
                    'dairy' => 'images/categories/th (1).jpeg',
                ];
            @endphp

            @foreach($categories as $category)
                <div class="col">
                    <div class="card shadow-sm border-0 h-100 text-center" style="border-radius: 12px; overflow: hidden;">
                        <div class="p-3 bg-white d-flex justify-content-center align-items-center" style="height: 180px; border-radius: 12px 12px 0 0;">
                            <img src="{{ asset($imageMap[$category->slug] ?? 'images/categories/default.jpg') }}" alt="{{ $category->name }}" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold text-capitalize mb-3">{{ ucfirst($category->name) }}</h6>
                            <a href="{{ url('/shop?category=' . $category->id) }}" class="btn btn-outline-success btn-sm" style="border-radius: 8px; min-width: 100px;">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



<!-- ✅ PRODUCTS SECTION -->
<section class="ftco-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="text-uppercase fw-bold text-success" style="font-size: 28px;">Our Products</h2>
            <p class="text-muted">Explore the latest offers on items close to expiry</p>
        </div>

        <div class="owl-carousel owl-theme">
            @foreach($products as $product)
                <div class="item">
                    <div class="card h-100 shadow-sm border-0 rounded-3">
                        <a href="{{ url('shop/'.$product->id) }}" class="bg-white d-flex justify-content-center align-items-center" style="height: 200px;">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" style="max-height: 90%; object-fit: contain;">
                        </a>

                        <div class="card-body text-center">
                            <h6 class="fw-bold text-dark mb-2" style="min-height: 45px;">{{ $product->name }}</h6>

                            @if($product->discount_price)
                                <p class="mb-2">
                                    <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-success fw-bold ms-2">${{ number_format($product->discount_price, 2) }}</span>
                                </p>
                            @else
                                <p class="mb-2 text-success fw-bold">${{ number_format($product->price, 2) }}</p>
                            @endif

                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-outline-success btn-sm" style="border-radius: 8px; min-width: 100px;">View Details</a>
                                @auth
                                    @if(auth()->user()->role === 'customer')
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm" style="border-radius: 8px; min-width: 100px;">Add to Cart</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>


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




  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
<!-- ✅ مودال تسجيل الدخول مع عرض الأخطاء -->
<div id="loginModal" style="display:{{ $errors->has('email') || $errors->has('password') ? 'flex' : 'none' }};position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:9999;justify-content:center;align-items:center;">
    <div style="background:white;padding:30px;border-radius:10px;width:90%;max-width:400px;box-shadow:0px 5px 20px rgba(0,0,0,0.3);position:relative;">
      <button onclick="closeLoginModal()" style="position:absolute;top:10px;right:10px;font-size:24px;border:none;background:none;color:#333;">&times;</button>
      <h2 style="text-align:center;margin-bottom:20px;font-weight:bold;color:#8dc63f;">Login</h2>

      <!-- ✅ رسالة الخطأ -->
      @if ($errors->any())
        <div style="color: #e3342f; font-size: 14px; margin-top: 6px; background-color: #fdecea; padding: 8px 10px; border-radius: 5px;">
            {{ $errors->first() }}
        </div>
    @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-4">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success px-4 py-2" style="border-radius:25px;">Login</button>
        </div>
      </form>
    </div>
  </div>

  <div id="registerModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:9999;justify-content:center;align-items:center;">
    <div style="background:white;padding:30px;border-radius:10px;width:90%;max-width:400px;box-shadow:0px 5px 20px rgba(0,0,0,0.3);position:relative;">
        <button onclick="closeRegisterModal()" style="position:absolute;top:10px;right:10px;font-size:24px;border:none;background:none;color:#333;">&times;</button>
        <h2 style="text-align:center;margin-bottom:20px;font-weight:bold;color:#8dc63f;">Register</h2>

        @if ($errors->any())
            <div style="color: #e3342f; font-size: 14px; margin-top: 6px; background-color: #fdecea; padding: 8px 10px; border-radius: 5px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="form-group mb-4">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success px-4 py-2" style="border-radius:25px;">Register</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRegisterModal() {
        document.getElementById('registerModal').style.display = 'flex';
    }
    function closeRegisterModal() {
        document.getElementById('registerModal').style.display = 'none';
    }
</script>

  <!-- ✅ سكربت فتح وإغلاق المودال -->
  <script>
  function openLoginModal() {
      document.getElementById('loginModal').style.display = 'flex';
  }
  function closeLoginModal() {
      document.getElementById('loginModal').style.display = 'none';
  }
  </script>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            responsive:{
                0:{ items:1 },
                576:{ items:2 },
                768:{ items:3 },
                992:{ items:4 }
            }
        });
    });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  </body>
</html>

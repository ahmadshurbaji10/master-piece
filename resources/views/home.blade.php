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
  </head>
  <body class="goto-here">
		{{-- <div class="py-1 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">00962775432428</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">youremail@email.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text">3-5 Business days delivery &amp; Free Returns</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div> --}}
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
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
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

	            <div class="col-md-12 ftco-animate text-center">
	              <h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
	              <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                  <p><a href="{{ url('/shop') }}" class="btn btn-primary">Shop now</a></p>
	            </div>

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

        <!-- ✅ Section Title -->
<div class="text-center my-5">
    <h2 class="text-uppercase font-weight-bold" style="font-size: 28px; color: #82ae46;">
        Product Categories
    </h2>
    <p class="text-muted">Browse items by type to find what you need</p>
</div>

		<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <!-- القسم الكبير 8 أعمدة -->
            <div class="col-md-8">
                <div class="row">
                    <!-- صورة Vegetables بالنص -->
                    <div class="col-md-6 order-md-last align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate align-self-stretch d-flex flex-column justify-content-center align-items-center p-4" style="background-color: #f8f9fa;">
                            <img src="{{ asset('images/category.jpg') }}" alt="Vegetables" class="img-fluid mb-3" style="height: 200px; object-fit: contain;">
                            <div class="text text-center">
                                <h2>Vegetables</h2>
                                <p>Protect the health of every home</p>
                                <p><a href="{{ url('/shop') }}" class="btn btn-primary">Shop now</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- الصورتين على اليسار -->
                    <div class="col-md-6">
                        <div class="category-wrap ftco-animate mb-4 d-flex align-items-end justify-content-center p-3" style="background-color: #fff;">
                            <img src="{{ asset('images/OP.jpg') }}" class="img-fluid border rounded shadow-sm" style="height: 200px; object-fit: contain; border-color: #ccc;" alt="Grains">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a href="/shop">grains</a></h2>
                            </div>
                        </div>
                        <div class="category-wrap ftco-animate d-flex align-items-end justify-content-center p-3" style="background-color: #fff;">
                            <img src="{{ asset('images/8b6468bd-1a9a-478a-9c0a-abb8fe8daaf4.png') }}" class="img-fluid border rounded shadow-sm" style="height: 200px; object-fit: contain; border-color: #ccc;" alt="Oils">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a href="/shop">oils</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- القسم الصغير 4 أعمدة -->
            <div class="col-md-3">
                <div class="category-wrap ftco-animate mb-4 d-flex align-items-end justify-content-center p-3" style="background-color: #fff;">
                    <img src="{{ asset('images/0032894010131-v360-016.jpg') }}" class="img-fluid w-100 border rounded shadow-sm" style="height: 200px; object-fit: contain;" alt="Canned">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="/shop">canned</a></h2>
                    </div>
                </div>

                <div class="category-wrap ftco-animate d-flex align-items-end justify-content-center p-3" style="background-color: #fff;">
                    <img src="{{ asset('images/mat.jpg') }}" class="img-fluid w-100 border rounded shadow-sm" style="height: 200px; object-fit: contain;" alt="Juices">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="/shop">juices</a></h2>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


    <section class="ftco-section">
    	<!-- ✅ Products Section Title -->
<div class="text-center my-5">
    <h2 class="text-uppercase font-weight-bold" style="font-size: 28px; color: #82ae46;">
        Our Products
    </h2>
    <p class="text-muted">Explore the latest offers on items close to expiry</p>
</div>

    	<div class="container">
    		<div class="row">

    			@foreach($products as $product)
    <div class="col-md-6 col-lg-3 ftco-animate mb-5">
        <div class="product shadow-sm rounded overflow-hidden" style="background: #fff;">
            <a href="{{ url('shop/'.$product->id) }}" class="img-prod d-flex justify-content-center align-items-center" style="background: #f8f9fa; height: 250px;">
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                     style="max-height: 90%; max-width: 90%; object-fit: contain;">
                @if($product->discount_price)
                    <span class="status">
                        {{ intval(100 - ($product->discount_price / $product->price) * 100) }}%
                    </span>
                @endif
                <div class="overlay"></div>
            </a>

            <div class="text py-3 pb-4 px-3 text-center">
                <h3 class="mb-2" style="min-height: 48px;">
                    <a href="{{ url('shop/'.$product->id) }}" class="text-dark">{{ $product->name }}</a>
                </h3>

                <div class="d-flex justify-content-center mb-2">
                    <div class="pricing">
                        @if($product->discount_price)
                            <p class="price">
                                <span class="mr-2 price-dc">${{ number_format($product->price, 2) }}</span>
                                <span class="price-sale text-success">${{ number_format($product->discount_price, 2) }}</span>
                            </p>
                        @else
                            <p class="price">
                                <span class="price-sale">${{ number_format($product->price, 2) }}</span>
                            </p>
                        @endif
                    </div>
                </div>

                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-outline-success btn-sm mt-2">👁️ View Details</a>

            </div>
        </div>
    </div>
@endforeach






		{{-- <section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
    	<div class="container">
				<div class="row justify-content-end">
          <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
          	<span class="subheading">Best Price For You</span>
            <h2 class="mb-4">Deal of the day</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            <h3><a href="#">Spinach</a></h3>
            <span class="price">$10 <a href="#">now $5 only</a></span>
            <div id="timer" class="d-flex mt-5">
						  <div class="time" id="days"></div>
						  <div class="time pl-3" id="hours"></div>
						  <div class="time pl-3" id="minutes"></div>
						  <div class="time pl-3" id="seconds"></div>
						</div>
          </div>
        </div>
    	</div>
    </section> --}}


    <hr>

		{{-- <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section> --}}
    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Vegefoods</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
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

  <!-- ✅ سكربت فتح وإغلاق المودال -->
  <script>
  function openLoginModal() {
      document.getElementById('loginModal').style.display = 'flex';
  }
  function closeLoginModal() {
      document.getElementById('loginModal').style.display = 'none';
  }
  </script>

  </body>
</html>

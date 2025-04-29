<!-- ✅ Navbar -->
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

  <!-- ✅ Modal Login -->
  <!-- ✅ Modal Login -->
<div id="loginModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 40px 30px; border-radius: 12px; max-width: 400px; width: 100%; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
      <button onclick="closeLoginModal()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 20px;">&times;</button>

      <h2 class="mb-4 text-center" style="color: #66bb6a; font-weight: 700; font-size: 28px;">Login</h2>

      <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
              <label class="form-label text-start d-block" style="color: #666;">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" style="border: 1px solid #ccc; color: #555; background-color: #fff;" required>
          </div>
          <div class="mb-4">
              <label class="form-label text-start d-block" style="color: #666;">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" style="border: 1px solid #ccc; color: #555; background-color: #fff;" required>
          </div>
          <div class="text-center">
              <button type="submit" class="btn btn-success rounded-pill py-2 px-4" style="font-weight: 500;">Login</button>
          </div>
      </form>
    </div>
  </div>

  <!-- ✅ JavaScript -->
  <script>
  function openLoginModal() {
    document.getElementById('loginModal').style.display = 'flex';
  }
  function closeLoginModal() {
    document.getElementById('loginModal').style.display = 'none';
  }
  </script>

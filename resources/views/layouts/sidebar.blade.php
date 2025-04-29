<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Sidebar</title>

    <!-- ✅ CSS Files -->
    <link href="{{ asset('assetss/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assetss/css/light-bootstrap-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assetss/css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('assetss/fonts/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/fonts/pe-icon-7-stroke.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- ✅ Sidebar Start -->
    <div class="sidebar" data-color="purple" data-image="{{ asset('assetss/img/sidebar-5.jpg') }}">
        <div class="sidebar-wrapper">
            <div class="logo text-center py-3">
                <a href="#" class="simple-text fw-bold fs-5 text-white">VENDOR PANEL</a>
            </div>
            <ul class="nav flex-column text-white">
                <li class="{{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('vendor.dashboard') }}">
                        <i class="fa fa-chart-line me-2"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('vendor/products*') ? 'active' : '' }}">
                    <a href="{{ route('vendor.products.index') }}">
                        <i class="fa fa-boxes-stacked me-2"></i> <span>My Products</span>
                    </a>
                </li>
                <li class="{{ request()->is('vendor/orders*') ? 'active' : '' }}">
                    <a href="{{ route('vendor.orders.index') }}">
                        <i class="fa fa-receipt me-2"></i> <span>My Orders</span>
                    </a>
                </li>
                <li class="{{ request()->is('vendor/account') ? 'active' : '' }}">
                    <a href="{{ route('vendor.account') }}">
                        <i class="fa fa-user me-2"></i> <span>My Account</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt me-2 text-danger"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <!-- ✅ Sidebar End -->

    <!-- ✅ JS Files -->
    <script src="{{ asset('assetss/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assetss/js/core/bootstrap.min.js') }}"></script>

</body>
</html>

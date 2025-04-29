<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Vendor Dashboard')</title>

    <!-- ✅ Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- ✅ Sidebar بلون أخضر مثل الأدمن -->
    <aside class="w-64 fixed top-0 left-0 h-full bg-gradient-to-b from-green-700 to-green-600 text-white flex flex-col shadow-lg z-20">
        <div class="text-2xl font-bold py-6 border-b border-green-500 text-center">
            VENDOR PANEL
        </div>

        <nav class="flex-1 px-4 pt-4 space-y-4">
            <a href="{{ route('vendor.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->routeIs('vendor.dashboard') ? 'bg-green-800' : '' }}">
                <i class="fas fa-chart-line mr-3 text-xl"></i> Dashboard
            </a>

            <a href="{{ route('vendor.products.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->is('vendor/products*') ? 'bg-green-800' : '' }}">
                <i class="fas fa-box mr-3 text-xl"></i> My Products
            </a>

            <a href="{{ route('vendor.orders.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->is('vendor/orders*') ? 'bg-green-800' : '' }}">
                <i class="fas fa-receipt mr-3 text-xl"></i> My Orders
            </a>

            <a href="{{ route('vendor.account') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->is('vendor/account') ? 'bg-green-800' : '' }}">
                <i class="fas fa-user mr-3 text-xl"></i> My Account
            </a>
        </nav>
    </aside>

    <!-- ✅ Main Panel -->
    <div class="flex-1 flex flex-col ml-64 min-h-screen">

        <!-- ✅ Navbar -->
        <nav class="sticky top-0 bg-white shadow flex items-center justify-between px-8 py-4 z-10">
            <div class="text-2xl font-bold text-gray-800">
                @yield('page_title', 'Vendor Dashboard')
            </div>

            <div class="relative">
                <button id="profileButton" class="flex items-center space-x-3 focus:outline-none">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=34D399&color=fff&size=64"
                         class="w-10 h-10 rounded-full border-2 border-green-400 shadow-md" alt="Vendor Avatar">
                    <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                </button>

                <!-- Dropdown -->
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 transition-all duration-300">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- ✅ Page Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

</div>

<!-- ✅ Script للDropdown -->
<script>
    const profileButton = document.getElementById('profileButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>

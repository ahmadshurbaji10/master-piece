<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- ✅ Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- ✅ Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-green-700 to-green-600 text-white flex flex-col shadow-lg">
        <div class="text-3xl font-bold py-6 border-b border-green-500 text-center">
            ADMIN PANEL
        </div>

        <nav class="flex-1 px-4 pt-6 space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->routeIs('admin.dashboard') ? 'bg-green-800' : '' }}">
                <i class="fas fa-tachometer-alt mr-3 text-xl"></i> <span class="text-lg">Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->is('admin/products*') ? 'bg-green-800' : '' }}">
                <i class="fas fa-box mr-3 text-xl"></i> <span class="text-lg">Manage Products</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->is('admin/users*') ? 'bg-green-800' : '' }}">
                <i class="fas fa-users mr-3 text-xl"></i> <span class="text-lg">Users</span>
            </a>
            <a href="{{ route('admin.discounts.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-800 {{ request()->is('admin/discounts*') ? 'bg-green-800' : '' }}">
                <i class="fas fa-tags mr-3 text-xl"></i> <span class="text-lg">Discounts</span>
            </a>
        </nav>
    </aside>

    <!-- ✅ Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- ✅ Navbar -->
        <nav class="bg-white shadow flex items-center justify-between px-8 py-4">
            <div class="text-2xl font-bold text-gray-800">
                @yield('page_title', 'Dashboard')
            </div>

            <div class="relative">
                <button id="profileButton" class="flex items-center space-x-3 focus:outline-none">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=34D399&color=fff&size=64"
                         class="w-10 h-10 rounded-full border-2 border-green-400 shadow-md" alt="User Avatar">
                    <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                </button>

                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                    <a class="dropdown-item px-4 py-2 block text-gray-700 hover:bg-gray-100" href="{{ route('admin.profile') }}">View Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- ✅ Content Area -->
        <div class="p-8 flex-1">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl p-6 text-center transition">
                    <p class="text-gray-500 font-semibold mb-2">Total Products</p>
                    <h3 class="text-4xl font-extrabold text-green-600">{{ $totalProducts ?? 0 }}</h3>
                </div>
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl p-6 text-center transition">
                    <p class="text-gray-500 font-semibold mb-2">Users</p>
                    <h3 class="text-4xl font-extrabold text-blue-600">{{ $totalUsers ?? 0 }}</h3>
                </div>
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl p-6 text-center transition">
                    <p class="text-gray-500 font-semibold mb-2">Total Orders</p>
                    <h3 class="text-4xl font-extrabold text-purple-600">{{ $totalOrders ?? 0 }}</h3>
                </div>
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl p-6 text-center transition">
                    <p class="text-gray-500 font-semibold mb-2">Revenue</p>
                    <h3 class="text-4xl font-extrabold text-yellow-500">${{ number_format($totalRevenue ?? 0, 2) }}</h3>
                </div>
            </div>

            <!-- Chart Section -->
            <!-- Chart Section -->
<div class="bg-white rounded-xl shadow-md p-6 mt-4">
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Statistics Overview</h3>
    <div class="w-full h-80">
        <canvas id="overviewBarChart"></canvas>
    </div>
</div>


            @yield('content')
        </div>
    </div>
</div>

<!-- ✅ Chart.js -->
<script>
    const ctx = document.getElementById('overviewBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Products', 'Users', 'Orders', 'Revenue'],
            datasets: [{
                label: 'Dashboard Data',
                data: [
                    {{ $totalProducts ?? 0 }},
                    {{ $totalUsers ?? 0 }},
                    {{ $totalOrders ?? 0 }},
                    {{ $totalRevenue ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.7)',
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(234, 179, 8, 0.7)'
                ],
                borderRadius: 6,
                borderSkipped: false,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (context.parsed.y !== null) {
                                label += ': ' + context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 14 }
                    }
                },
                x: {
                    ticks: {
                        font: { size: 14 }
                    }
                }
            }
        }
    });
</script>


</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .sidebar {
            background: linear-gradient(135deg, #15803d 0%, #166534 100%);
        }
        .stat-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            height: 350px;
        }
    </style>
</head>

<body class="bg-gray-50">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 sidebar text-white flex flex-col shadow-lg">
        <div class="text-2xl font-bold py-6 border-b border-green-600 text-center">
            ADMIN PANEL
        </div>
        <nav class="flex-1 px-4 pt-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 {{ request()->is('admin/products*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-box mr-3"></i> Manage Products
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 {{ request()->is('admin/orders*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-receipt mr-3"></i> Manage Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 {{ request()->is('admin/users*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-users mr-3"></i> Users
            </a>
            {{-- <li class="nav-item"> --}}
                <a  href="{{ route('coupons.index') }}"  class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 {{ request()->is('admin/coupons*') ? 'bg-green-700' : '' }}"" href="{{ route('coupons.index') }}">
                    <i class="fas fa-tags me-2"></i> Coupons
                </a>
            {{-- </li> --}}
            {{-- <a href="{{ route('admin.discounts.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 {{ request()->is('admin/discounts*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-tags mr-3"></i> Discounts
            </a> --}}
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Navbar -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="user-menu" class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=15803d&color=fff"
                                 class="w-8 h-8 rounded-full">
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Products -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Products</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalProducts ?? 0 }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Users</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUsers ?? 0 }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Orders</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalOrders ?? 0 }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Revenue</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">${{ number_format($totalRevenue ?? 0, 2) }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-dollar-sign text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row of Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Orders Today -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Orders Today</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $ordersToday ?? 0  }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Expiring Soon -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Expiring Soon</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $expiringSoon ?? 0 }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- New Users This Week -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">New Users This Week</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $newUsersThisWeek ?? 0 }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                            <i class="fas fa-user-plus text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Most Ordered Product -->
                <div class="stat-card bg-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Most Ordered Product</p>
                            @if(isset($topProductName) && $topProductName !== 'N/A')
                                <h3 class="text-xl font-bold text-gray-900 mt-1">
                                    {{ $topProductName }}
                                    <span class="text-sm text-gray-500 font-medium">({{ $topProductQuantity }} times)</span>
                                </h3>
                            @else
                                <h3 class="text-xl font-bold text-gray-400 mt-1">N/A</h3>
                            @endif
                        </div>
                        <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                            <i class="fas fa-star text-xl"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Chart Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Statistics Overview</h3>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-lg">Weekly</button>
                        <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg">Monthly</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="overviewChart"></canvas>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Chart.js Implementation
    const ctx = document.getElementById('overviewChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'Revenue',
                    data: [500, 600, 700, 800, 900, 800, 700],
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Orders',
                    data: [200, 300, 400, 500, 400, 300, 400],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
</body>
</html>

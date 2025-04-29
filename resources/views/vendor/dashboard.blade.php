@extends('layouts.vendor-sidebar')

@section('title', '📊 Dashboard')
@section('page_title', 'Vendor Dashboard')

@section('content')

<!-- ✅ Cards Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- My Products -->
    <div class="bg-white rounded-xl shadow hover:shadow-2xl p-6 text-center transition">
        <p class="text-gray-500 text-md font-semibold mb-2">My Products</p>
        <h3 class="text-4xl font-extrabold text-blue-600">{{ $productCount }}</h3>
    </div>

    <!-- Orders -->
    <div class="bg-white rounded-xl shadow hover:shadow-2xl p-6 text-center transition">
        <p class="text-gray-500 text-md font-semibold mb-2">Orders</p>
        <h3 class="text-4xl font-extrabold text-green-600">{{ $orderCount }}</h3>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-xl shadow hover:shadow-2xl p-6 text-center transition">
        <p class="text-gray-500 text-md font-semibold mb-2">Total Revenue</p>
        <h3 class="text-4xl font-extrabold text-yellow-500">${{ number_format($totalRevenue, 2) }}</h3>
    </div>

    <!-- Expiring Soon -->
    <div class="bg-white rounded-xl shadow hover:shadow-2xl p-6 text-center transition">
        <p class="text-gray-500 text-md font-semibold mb-2">Expiring Soon</p>
        <h3 class="text-4xl font-extrabold text-cyan-500">{{ $expiringSoonCount }}</h3>
    </div>
</div>

<!-- ✅ Pie Chart Section -->
<div class="bg-white rounded-xl shadow hover:shadow-2xl p-6 transition">
    <h4 class="text-lg font-bold mb-6 text-gray-700">Sold vs Remaining</h4>
    <div class="flex flex-col items-center">
        <canvas id="productPieChart" width="400" height="300"></canvas>
        <p class="mt-4 text-gray-700">
            <strong>{{ $soldPercentage }}%</strong> Sold —
            <strong>{{ $remainingPercentage }}%</strong> In Stock
        </p>
    </div>
</div>

@endsection

@push('scripts')
<!-- ✅ Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('productPieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Sold', 'In Stock'],
            datasets: [{
                data: [{{ $soldPercentage }}, {{ $remainingPercentage }}],
                backgroundColor: ['#ef4444', '#10b981'] // أحمر وأخضر فاتح
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush

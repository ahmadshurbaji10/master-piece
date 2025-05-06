<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #28a745;
        }

        .tab-button {
            border: none;
            background: none;
            font-weight: 500;
            font-size: 1rem;
            margin-right: 25px;
            cursor: pointer;
            color: #333;
            padding: 8px 0;
        }

        .tab-button.active {
            color: #28a745;
            border-bottom: 2px solid #28a745;
        }

        .table-orders {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table-orders th {
            background-color: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
        }

        .table-orders td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .table-orders tr:last-child td {
            border-bottom: none;
        }

        .table-orders tr:hover {
            background-color: rgba(40, 167, 69, 0.05);
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .btn-outline-primary {
            border-color: #28a745;
            color: #28a745;
        }

        .btn-outline-primary:hover {
            background-color: #28a745;
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tab-section {
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</head>
<body>

@include('navbar')

<section class="ftco-section py-4">
    <div class="container">

        <h3 class="fw-bold mb-3 text-center">👋 Welcome, {{ auth()->user()->name }}</h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabs -->
        <div class="d-flex justify-content-center mb-4 border-bottom pb-2">
            <button class="tab-button active" onclick="showTab('orders')">🧾 Orders</button>
            <button class="tab-button" onclick="showTab('profile')">👤 Profile</button>
        </div>

        <!-- Orders Table -->
        <div id="orders" class="tab-section">
            <h4 class="section-title">📦 Your Orders</h4>
            @if($orders->count())
                <div class="table-responsive">
                    <table class="table-orders">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Product</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                @php $firstItem = $order->items->first(); @endphp
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>
                                        {{ $firstItem->product->name ?? 'Order #' . $order->id }}
                                        @if($order->items->count() > 1)
                                            <small class="text-muted">+{{ $order->items->count() - 1 }} more</small>
                                        @endif
                                    </td>
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        @if($order->status === 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">You haven't made any orders yet.</div>
            @endif
        </div>

        <!-- Profile Section -->
        <div id="profile" class="tab-section d-none">
            <h4 class="section-title"><i class="fa fa-user me-2"></i>Update Profile</h4>
            <form action="{{ route('customer.profile.update') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">👤 Name</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">📧 Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>

                <hr>
                <h5><i class="fa fa-lock me-2 text-warning"></i>Change Password <small class="text-muted">(optional)</small></h5>

                <div class="mb-3">
                    <label class="form-label">🔑 New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                </div>

                <div class="mb-4">
                    <label class="form-label">✅ Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa fa-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

@include('footer')

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-section').forEach(el => el.classList.add('d-none'));
        document.getElementById(tabId).classList.remove('d-none');
        document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');
    }
</script>

</body>
</html>

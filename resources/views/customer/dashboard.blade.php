{{-- resources/views/customer/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .tab-button {
            border: none;
            background: none;
            font-weight: 500;
            font-size: 1.1rem;
            margin-right: 20px;
            cursor: pointer;
        }
        .tab-button.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }
        .order-img {
            height: 180px;
            width: auto;
            object-fit: contain;
            display: block;
            margin: auto;
            padding-top: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">

    <!-- ✅ زر تسجيل الخروج -->
    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="fa fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>

    <h2 class="mb-4">👋 Welcome, {{ auth()->user()->name }}</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <!-- ✅ Navigation Tabs -->
    <div class="d-flex mb-4 border-bottom pb-2">
        <button class="tab-button active" onclick="showTab('orders')">🧾 Orders</button>
        <button class="tab-button" onclick="showTab('products')">🛒 Products</button>
        <button class="tab-button" onclick="showTab('profile')">👤 Profile</button>
        <a href="{{ route('cart.index') }}" class="tab-button text-decoration-none">🧺 Cart</a>
        <a href="{{ route('cart.checkoutPage') }}" class="tab-button text-decoration-none">💳 Checkout</a>
    </div>

    <!-- ✅ Orders Section -->
    <div id="orders" class="tab-section">
        <h4 class="mb-4">📦 Your Orders</h4>
        @if($orders->count())
            <div class="row">
                @foreach($orders as $order)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            @php $firstItem = $order->items->first(); @endphp
                            <img src="{{ asset('storage/' . ($firstItem->product->image_url ?? 'images/default.jpg')) }}" class="order-img card-img-top">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">
                                        {{ $firstItem->product->name ?? 'Order #' . $order->id }}
                                        @if($order->items->count() > 1)
                                            + {{ $order->items->count() - 1 }} more
                                        @endif
                                    </h5>
                                    <p class="text-muted mb-2">Total: <strong>${{ number_format($order->total_price, 2) }}</strong></p>
                                    <p>
                                        Status:
                                        @if($order->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </p>
                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">You haven't made any orders yet.</div>
        @endif
    </div>

    <!-- ✅ Products Section -->
    <div id="products" class="tab-section d-none">
        <h4>🛍️ Available Products</h4>
        <div class="row mt-3">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" style="height: 220px; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">${{ number_format($product->price, 2) }}</p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ✅ Profile Section -->
    <div id="profile" class="tab-section d-none">
        <h4 class="mb-4"><i class="fa fa-user me-2"></i>Update Profile</h4>
        <form action="{{ route('customer.profile.update') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">👤 Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-bold">📧 Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
            </div>

            <hr>
            <h5 class="mb-3"><i class="fa fa-lock me-2 text-warning"></i>Change Password <small class="text-muted">(optional)</small></h5>

            <div class="mb-3">
                <label for="password" class="form-label">🔑 New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">✅ Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repeat new password">
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success px-4">
                    <i class="fa fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ✅ Script to switch tabs -->
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

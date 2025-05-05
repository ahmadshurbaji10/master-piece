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
        }

        .tab-button {
            border: none;
            background: none;
            font-weight: 500;
            font-size: 1rem;
            margin-right: 25px;
            cursor: pointer;
            color: #333;
        }

        .tab-button.active {
            color: #28a745;
            border-bottom: 2px solid #28a745;
        }

        .order-img {
            height: 170px;
            object-fit: contain;
            display: block;
            margin: auto;
        }

        .card-title {
            font-weight: 600;
            font-size: 18px;
        }

        .tab-section {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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
            {{-- <button class="tab-button" onclick="showTab('products')">🛒 Products</button> --}}
            <button class="tab-button" onclick="showTab('profile')">👤 Profile</button>
            {{-- <a href="{{ route('cart.index') }}" class="tab-button text-decoration-none">🧺 Cart</a>
            <a href="{{ route('cart.checkoutPage') }}" class="tab-button text-decoration-none">💳 Checkout</a> --}}
        </div>

        <!-- Orders -->
        <div id="orders" class="tab-section">
            <h4 class="section-title">📦 Your Orders</h4>
            @if($orders->count())
                <div class="row">
                    @foreach($orders as $order)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-sm h-100">
                                @php $firstItem = $order->items->first(); @endphp
                                <img src="{{ asset('storage/' . ($firstItem->product->image_url ?? 'images/default.jpg')) }}" class="order-img">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $firstItem->product->name ?? 'Order #' . $order->id }}
                                        @if($order->items->count() > 1)
                                            +{{ $order->items->count() - 1 }} more
                                        @endif
                                    </h5>
                                    <p>Total: <strong>${{ number_format($order->total_price, 2) }}</strong></p>
                                    <p>Status:
                                        @if($order->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </p>
                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">You haven't made any orders yet.</div>
            @endif
        </div>
{{--
        <!-- Products -->
        <div id="products" class="tab-section d-none">
            <h4 class="section-title">🛍️ Available Products</h4>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" style="height: 200px; object-fit: contain;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="mb-2">${{ number_format($product->price, 2) }}</p>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <!-- Profile -->
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

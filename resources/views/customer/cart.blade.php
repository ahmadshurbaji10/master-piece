<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🛒 Your Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --danger-color: #dc3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .cart-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 15px;
        }

        .cart-header {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table thead th {
            background-color: var(--light-color);
            padding: 16px;
            text-align: left;
            font-weight: 500;
            color: var(--secondary-color);
            border-bottom: 2px solid #eee;
        }

        .cart-table tbody td {
            padding: 16px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .product-title {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: #f8f9fa;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 6px;
            font-size: 14px;
        }

        .remove-btn {
            background: var(--danger-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .coupon-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 25px;
        }

        .coupon-input {
            border-radius: 8px 0 0 8px;
            border-right: none;
        }

        .coupon-btn {
            border-radius: 0 8px 8px 0;
            background: var(--primary-color);
            color: white;
            border: none;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .summary-total {
            font-weight: 600;
            font-size: 18px;
            color: var(--dark-color);
            border-bottom: none;
        }

        .checkout-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            margin-top: 20px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .checkout-btn:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .empty-cart-icon {
            font-size: 60px;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        /* Modal Styles */
        .checkout-modal .modal-content {
            border-radius: 12px;
            border: none;
        }

        .checkout-modal .modal-header {
            border-bottom: 1px solid #eee;
            padding: 20px;
        }

        .checkout-modal .modal-title {
            font-weight: 600;
        }

        .checkout-modal .modal-body {
            padding: 20px;
        }

        .checkout-modal .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }

        .checkout-modal .modal-footer {
            border-top: 1px solid #eee;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .cart-table thead {
                display: none;
            }

            .cart-table tr {
                display: block;
                margin-bottom: 20px;
                border-bottom: 2px solid #eee;
            }

            .cart-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: right;
                padding: 10px 15px;
            }

            .cart-table td::before {
                content: attr(data-label);
                font-weight: 500;
                color: var(--secondary-color);
                margin-right: auto;
                padding-right: 20px;
            }

            .quantity-control {
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>

@include('navbar')

<div class="cart-container">
    <h1 class="cart-header">
        <i class="fas fa-shopping-cart"></i> Your Cart
    </h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="cart-card">
            <div class="table-responsive">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <tr>
                                <td data-label="Product">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $item['image_url']) }}" class="product-img">
                                        <span class="product-title">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td data-label="Price">${{ number_format($item['price'], 2) }}</td>
                                <td data-label="Quantity">
                                    <div class="quantity-control">
                                        <form action="{{ route('cart.update', $id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="quantity-btn">-</button>
                                        </form>

                                        <form action="{{ route('cart.set', $id) }}" method="POST">
                                            @csrf
                                            @php $maxStock = $item['stock'] ?? \App\Models\Product::find($id)?->stock ?? 100; @endphp
                                            <input type="number" name="quantity" min="1" max="{{ $maxStock }}" class="quantity-input"
                                                   value="{{ $item['quantity'] }}" onchange="this.form.submit()">


                                        </form>

                                        <form action="{{ route('cart.update', $id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="quantity-btn">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td data-label="Total">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td data-label="Actions">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="remove-btn">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="coupon-card">
            <form action="{{ route('cart.applyCoupon') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="coupon_code" class="form-control coupon-input"
                           placeholder="Enter coupon code if available" required>
                    <button type="submit" class="btn coupon-btn">Apply Coupon</button>
                </div>
            </form>
        </div>

        @php
            $cart = session('cart', []);
            $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            $discount = 0;
            $couponCode = session('applied_coupon');

            if ($couponCode) {
                $coupon = \App\Models\Coupon::where('code', $couponCode)
                    ->where(function ($q) {
                        $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
                    })->first();

                if ($coupon && $coupon->usage_limit > 0) {
                    $discount = $coupon->discount_type === 'fixed'
                        ? $coupon->discount_amount
                        : ($coupon->discount_amount / 100) * $subtotal;

                    $discount = min($discount, $subtotal);
                }
            }

            $total = $subtotal - $discount;
        @endphp

        <div class="summary-card">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>${{ number_format($subtotal, 2) }}</span>
            </div>

            @if ($discount > 0)
                <div class="summary-row text-success">
                    <span>Discount:</span>
                    <span>-${{ number_format($discount, 2) }} (Code: {{ $couponCode }})</span>
                </div>
            @endif

            <div class="summary-row summary-total">
                <span>Total:</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>

            <button type="button" class="checkout-btn" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                <i class="fas fa-credit-card"></i> Proceed to Checkout
            </button>
        </div>

        <!-- Checkout Modal -->
        <div class="modal fade checkout-modal" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        @if(session('applied_coupon'))
                            <input type="hidden" name="coupon_code" value="{{ session('applied_coupon') }}">
                        @endif

                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select class="form-control" name="payment_method" id="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="cash">Cash</option>
                                    <option value="visa">Visa / MasterCard</option>
                                </select>
                            </div>

                            <div id="cashFields">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Shipping Address</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>

                            <div id="visaFields" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label">Card Holder Name</label>
                                    <input type="text" class="form-control" name="card_name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" class="form-control" name="card_number" maxlength="16"
                                           pattern="\d{16}" placeholder="XXXX XXXX XXXX XXXX">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" name="expiry_date"
                                               placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/\d{2}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CVV</label>
                                        <input type="password" class="form-control" name="cvv"
                                               maxlength="4" pattern="\d{3,4}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Start shopping to add items to your cart</p>
            <a href="/shop" class="btn btn-primary mt-3">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>
    @endif
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethod = document.getElementById('payment_method');
    const cashFields = document.getElementById('cashFields');
    const visaFields = document.getElementById('visaFields');
    const form = document.getElementById('checkoutForm');

    function toggleFields() {
        if (paymentMethod.value === 'cash') {
            cashFields.style.display = 'block';
            visaFields.style.display = 'none';
            cashFields.querySelectorAll('input').forEach(input => input.required = true);
            visaFields.querySelectorAll('input').forEach(input => input.required = false);
        } else if (paymentMethod.value === 'visa') {
            cashFields.style.display = 'none';
            visaFields.style.display = 'block';
            visaFields.querySelectorAll('input').forEach(input => input.required = true);
            cashFields.querySelectorAll('input').forEach(input => input.required = false);
        } else {
            cashFields.style.display = 'none';
            visaFields.style.display = 'none';
        }
    }

    paymentMethod.addEventListener('change', toggleFields);
    toggleFields();

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            form.classList.add('was-validated');
        } else {
            e.preventDefault();

            Swal.fire({
                icon: 'success',
                title: 'Order Confirmed!',
                text: 'Your order has been placed successfully.',
                confirmButtonText: 'OK'
            }).then(() => {
                form.submit();
            });
        }
    });
});
</script>
</body>
</html>

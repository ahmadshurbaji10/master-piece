<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🧺 Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        #visaFields, #cashFields {
            display: none;
        }
    </style>
</head>
<body class="goto-here bg-light">

@include('navbar')

<section class="ftco-section">
    <div class="container">
        <h2 class="mb-4">🧺 Your Cart</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(count($cart) > 0)
            <table class="table table-bordered bg-white shadow-sm">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th style="width: 150px;">Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image_url']) }}" class="cart-img"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td class="d-flex align-items-center">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline me-2">
                                    @csrf
                                    <input type="hidden" name="action" value="decrease">
                                    <button class="btn btn-sm btn-outline-secondary">-</button>
                                </form>
                                <span class="mx-2">{{ $item['quantity'] }}</span>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline ms-2">
                                    @csrf
                                    <input type="hidden" name="action" value="increase">
                                    <button class="btn btn-sm btn-outline-secondary">+</button>
                                </form>
                            </td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">🗑 Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-secondary">
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Proceed to Checkout -->
            <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                🧾 Proceed to Checkout
            </button>

            <!-- Checkout Modal -->
            <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkoutModalLabel">Checkout Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!-- Cash Fields -->
                                <div id="cashFields">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Shipping Address</label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div>

                                <!-- Visa Fields -->
                                <div id="visaFields">
                                    <div class="mb-3">
                                        <label class="form-label">Card Holder Name</label>
                                        <input type="text" class="form-control" name="card_name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" class="form-control" name="card_number" maxlength="16" pattern="\d{16}" placeholder="XXXX XXXX XXXX XXXX">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" name="expiry_date" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/\d{2}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">CVV</label>
                                            <input type="password" class="form-control" name="cvv" maxlength="4" pattern="\d{3,4}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div class="mb-3">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-control" name="payment_method" id="payment_method" required>
                                        <option value="">Select</option>
                                        <option value="cash">Cash</option>
                                        <option value="visa">Visa / MasterCard</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Confirm Order</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4">🛒 Your cart is empty.</div>
        @endif
    </div>
</section>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            cashFields.querySelectorAll('input').forEach(input => input.required = false);
            visaFields.querySelectorAll('input').forEach(input => input.required = false);
        }
    }

    paymentMethod.addEventListener('change', toggleFields);
    toggleFields();

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('checkoutForm');
    const paymentMethod = document.getElementById('payment_method');

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            form.classList.add('was-validated');
        } else {
            e.preventDefault(); // وقف الإرسال الحقيقي فقط للتجريب

            Swal.fire({
                icon: 'success',
                title: 'Order Confirmed 🎉',
                text: 'Your order has been placed successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                form.submit(); // فعّل الإرسال بعد التأكيد
            });
        }
    });

    const toggleFields = () => {
        const cashFields = document.getElementById('cashFields');
        const visaFields = document.getElementById('visaFields');

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
    };

    paymentMethod.addEventListener('change', toggleFields);
    toggleFields();
});
</script>

</body>
</html>

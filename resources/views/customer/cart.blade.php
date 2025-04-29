<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🧺 Shopping Cart</title>

    <!-- Bootstrap 5 ✅ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
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
                        <td>
                            <img src="{{ asset('storage/' . $item['image_url']) }}" class="cart-img">
                        </td>
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

        <!-- ✅ زر فتح المودال -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal">
            🧾 Proceed to Checkout
        </button>

        <!-- ✅ مودال الفورم -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel">Checkout Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-control" name="payment_method" required>
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
        <div class="alert alert-info">🛒 Your cart is empty.</div>
    @endif
</div>

<!-- ✅ سكربتات Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentSelect = document.querySelector('select[name="payment_method"]');
    const nameInput = document.querySelector('input[name="name"]');
    const addressInput = document.querySelector('input[name="address"]');
    const confirmButton = document.querySelector('button[type="submit"]');

    function disableFormFields(disabled) {
        nameInput.disabled = disabled;
        addressInput.disabled = disabled;
        confirmButton.disabled = disabled;
    }

    paymentSelect.addEventListener('change', function () {
        if (this.value === 'visa') {
            Swal.fire({
                icon: 'info',
                title: 'Coming Soon 🚀',
                text: 'Visa/MasterCard payments will be available soon.',
            });

            disableFormFields(true); // يقفل الحقول والزر
        } else if (this.value === 'cash') {
            disableFormFields(false); // يفتح الحقول والزر
        } else {
            disableFormFields(true); // في حال اختار "Select"
        }
    });

    // أول تحميل الصفحة: خليه مغلق إلا لما يختار Cash
    disableFormFields(true);
});
</script>

</body>
</html>

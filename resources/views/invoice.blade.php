<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding: 30px;
            color: #333;
        }
        h2 {
            color: #222;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f4f4f4;
            text-align: left;
        }
        .total {
            font-weight: bold;
        }
        .section {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

    <h2>🧾 Invoice</h2>

    <div class="section">
        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->toDateString() }}</p>
    </div>

    <div class="section">
        <h4>Customer Info</h4>
        <p><strong>Name:</strong> {{ $customer['name'] ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $customer['address'] ?? 'N/A' }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($customer['payment_method'] ?? 'N/A') }}</p>
    </div>

    <div class="section">
        <h4>Order Items</h4>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="total">Total:</td>
                    <td class="total">${{ number_format($order->total_price, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p>Thank you for your order! 💚</p>

</body>
</html>

@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold">
            <i class="fas fa-box me-2"></i> Manage Orders
        </h2>
    </div>

    <div class="card border-0 shadow rounded-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-center">Order ID</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3 text-center">Total</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Date</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td class="px-4 py-3 text-center fw-bold">#{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->user->name }}</td>
                            <td class="px-4 py-3 text-center">${{ number_format($order->total_price, 2) }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="badge
                                    @if($order->status === 'pending') bg-warning text-dark
                                    @elseif($order->status === 'completed') bg-success
                                    @elseif($order->status === 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif px-3 py-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-sm btn-outline-primary px-3"
                                       title="View Order">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-success px-3"
                                                title="Complete Order">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif

                                    @if(in_array($order->status, ['pending', 'completed']))
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger px-3"
                                                title="Cancel Order"
                                                onclick="return confirm('Are you sure you want to cancel this order?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-2x mb-3"></i><br>
                                No orders found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        vertical-align: middle;
    }
    .table tbody td {
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 6px;
        min-width: 90px;
    }
    .btn-sm {
        border-radius: 6px;
        min-width: 36px;
    }
    .card {
        border-radius: 12px;
    }
</style>
@endsection

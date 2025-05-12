@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold">
            <i class="fas fa-box me-2"></i> Manage Orders
        </h2>
    </div>

    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-center" style="width: 10%">Order ID</th>
                            <th class="px-4 py-3 text-start" style="width: 20%">Customer</th>
                            <th class="px-4 py-3 text-end" style="width: 15%">Total</th>
                            <th class="px-4 py-3 text-center" style="width: 15%">Status</th>
                            <th class="px-4 py-3 text-center" style="width: 15%">Date</th>
                            <th class="px-4 py-3 text-center" style="width: 25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr class="border-bottom">
                            <td class="px-4 py-3 text-center fw-bold align-middle">#{{ $order->id }}</td>
                            <td class="px-4 py-3 text-start align-middle">{{ $order->user->name }}</td>
                            <td class="px-4 py-3 text-end align-middle fw-bold">${{ number_format($order->total_price, 2) }}</td>
                            <td class="px-4 py-3 text-center align-middle">
                                <span class="badge
                                    @if($order->status === 'pending') bg-warning text-dark
                                    @elseif($order->status === 'completed') bg-success
                                    @elseif($order->status === 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif px-3 py-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
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
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.03);
    }
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
        font-size: 0.925rem;
    }
    .table thead th {
        border-bottom: 1px solid #e9ecef;
        font-weight: 600;
        vertical-align: middle;
        background-color: #f8f9fa;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
    }
    .table tbody td {
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        padding: 12px 16px;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.03);
    }
    .badge {
        font-weight: 500;
        font-size: 0.8rem;
        border-radius: 4px;
        min-width: 80px;
        letter-spacing: 0.5px;
        padding: 5px 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-sm {
        border-radius: 4px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
    }
    .btn-outline-success {
        border-color: #198754;
        color: #198754;
    }
    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    .text-muted {
        color: #6c757d !important;
    }
    .text-end {
        text-align: end !important;
    }
</style>
@endsection

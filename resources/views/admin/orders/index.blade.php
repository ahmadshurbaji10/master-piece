@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')

<div class="container py-4">
    <h2 class="mb-4 text-success fw-bold d-flex align-items-center">
        <i class="fas fa-box me-2"></i> Manage Orders
    </h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td><strong>${{ number_format($order->total_price, 2) }}</strong></td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td><small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No orders found.</td>
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
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        border-bottom: 1px solid #dee2e6;
        border-top: none;
        font-weight: 600;
        padding: 12px 15px;
        background-color: #f8f9fa;
    }

    .table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(130, 174, 70, 0.05);
    }

    .badge {
        padding: 5px 10px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.8rem;
        border-radius: 5px;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }
</style>

@endsection

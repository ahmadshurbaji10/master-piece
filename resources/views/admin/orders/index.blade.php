@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-success fw-bold">
            <i class="fas fa-box me-2"></i> Manage Orders
        </h2>
    </div>

    <div class="card border-0 shadow-sm rounded-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4 text-center">Order ID</th>
                            <th class="py-3 px-4 text-center">User</th>
                            <th class="py-3 px-4 text-center">Total</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-center">Date</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td class="py-3 px-4 text-center">#{{ $order->id }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->user->name }}</td>
                            <td class="py-3 px-4 text-center"><strong>${{ number_format($order->total_price, 2) }}</strong></td>
                            <td class="py-3 px-4 text-center">
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2 d-inline-block">Pending</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-success px-3 py-2 d-inline-block">Completed</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 d-inline-block">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center"><small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small></td>
                            <td class="py-3 px-4 text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success px-3">
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
    .container-fluid {
        padding-right: 2rem;
        padding-left: 2rem;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
    }

    .table tbody td {
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(25, 135, 84, 0.05);
    }

    .badge {
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 6px;
        min-width: 80px;
        text-align: center;
    }

    .btn-sm {
        border-radius: 6px;
        min-width: 32px;
    }

    .card {
        border-radius: 12px;
    }

    .text-center {
        text-align: center !important;
    }
</style>

@endsection

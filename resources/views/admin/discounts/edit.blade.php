@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            ✏️ Edit Discount
        </div>
        <div class="card-body">
            <form action="{{ route('admin.discounts.update', $discount->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Product name (read-only) -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Product</label>
                    <input type="text" class="form-control" value="{{ $discount->product->name }}" disabled>
                </div>

                <!-- Percentage -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Discount Percentage (%)</label>
                    <input type="number" name="discount_percentage" step="0.01" min="0" max="100" class="form-control" value="{{ old('discount_percentage', $discount->discount_percentage) }}" required>
                </div>

                <!-- Start Date -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $discount->start_date) }}" required>
                </div>

                <!-- End Date -->
                <div class="mb-4">
                    <label class="form-label fw-bold">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $discount->end_date) }}" required>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('admin.discounts.index') }}" class="btn btn-outline-secondary">
                        ⬅ Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        💾 Update Discount
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

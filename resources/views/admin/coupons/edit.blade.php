@extends('layouts.admin')

@section('title', 'Admin | Edit Coupon')
@section('page_title', 'Edit Coupon')

@section('content')

<!-- 🎟️ Edit Coupon Section -->
<div class="bg-white shadow-md rounded-lg p-6">

    <!-- 🔝 Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Edit Coupon: {{ $coupon->code }}</h3>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 📋 Edit Form -->
    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Coupon Code -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Coupon Code</label>
                <input type="text" name="code" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('code', $coupon->code) }}" required>
            </div>

            <!-- Discount Type -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Discount Type</label>
                <select name="discount_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                    <option value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                    <option value="percentage" {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                </select>
            </div>

            <!-- Discount Amount -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Discount Amount</label>
                <input type="number" step="0.01" name="discount_amount"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('discount_amount', $coupon->discount_amount) }}" required>
            </div>

            <!-- Usage Limit -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Usage Limit</label>
                <input type="number" name="usage_limit"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('usage_limit', $coupon->usage_limit) }}" required>
            </div>

            <!-- Expiry Date -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Expiry Date</label>
                <input type="date" name="expires_at"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('expires_at', optional($coupon->expires_at)->format('Y-m-d')) }}">
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 mt-6">
            <a href="{{ route('coupons.index') }}" class="px-5 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">
                Back
            </a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Update Coupon
            </button>
        </div>
    </form>

</div>

@endsection

@extends('layouts.admin')

@section('title', 'Admin | Manage Coupons')
@section('page_title', 'Manage Coupons')

@section('content')

<!-- 🎟️ Coupons Management Section -->
<div class="bg-white shadow-md rounded-lg p-6">

    <!-- 🔝 Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">All Coupons</h3>
        <a href="{{ route('coupons.create') }}" class="px-5 py-2 bg-green-600 text-white font-semibold text-sm rounded-lg hover:bg-green-700 transition">
            ➕ Add Coupon
        </a>
    </div>

    <!-- 📋 Coupons Table -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-green-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border text-center">#</th>
                    <th class="px-4 py-3 border">Code</th>
                    <th class="px-4 py-3 border">Type</th>
                    <th class="px-4 py-3 border">Amount</th>
                    <th class="px-4 py-3 border">Used / Limit</th>
                    <th class="px-4 py-3 border">Expires At</th>
                    <th class="px-4 py-3 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border font-medium">{{ $coupon->code }}</td>
                        <td class="px-4 py-3 border capitalize">{{ $coupon->discount_type }}</td>
                        <td class="px-4 py-3 border">
                            @if($coupon->discount_type === 'percentage')
                                {{ $coupon->discount_amount }}%
                            @else
                                ${{ number_format($coupon->discount_amount, 2) }}
                            @endif
                        </td>
                        <td class="px-4 py-3 border">{{ $coupon->used_times }} / {{ $coupon->usage_limit }}</td>
                        <td class="px-4 py-3 border">
                            @if($coupon->expires_at)
                                {{ \Carbon\Carbon::parse($coupon->expires_at)->format('M d, Y') }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-4 py-3 border text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium px-2 py-1 bg-blue-50 rounded hover:bg-blue-100">
                                    Edit
                                </a>
                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium px-2 py-1 bg-red-50 rounded hover:bg-red-100">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500 text-lg">
                            No coupons found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

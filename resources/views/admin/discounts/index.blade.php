@extends('layouts.admin')

@section('title', 'Admin | Manage Discounts')
@section('page_title', 'Manage Discounts')

@section('content')

<div class="bg-white shadow-md rounded-lg p-6">

    <!-- 🔝 Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">🏷️ All Discounts</h3>
        <a href="{{ route('admin.discounts.create') }}" class="px-5 py-2 bg-green-600 text-white font-semibold text-sm rounded-lg hover:bg-green-700 transition">
            ➕ Add Discount
        </a>
    </div>

    <!-- ✅ If Product Filter Active -->
    @if(request('product_id') && $discounts->count())
        <div class="mb-6">
            <h4 class="text-base font-semibold text-gray-700">
                Showing discounts for:
                <span class="text-green-700 font-bold">{{ $discounts->first()->product->name }}</span>
                <a href="{{ route('admin.discounts.index') }}" class="ml-4 text-red-600 text-sm hover:underline">❌ Clear Filter</a>
            </h4>
        </div>
    @endif

    <!-- 📋 Discounts Table -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-green-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border text-center">#</th>
                    <th class="px-4 py-3 border">Product</th>
                    <th class="px-4 py-3 border text-center">Discount %</th>
                    <th class="px-4 py-3 border text-center">Start Date</th>
                    <th class="px-4 py-3 border text-center">End Date</th>
                    <th class="px-4 py-3 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($discounts as $discount)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border">{{ $discount->product->name ?? '—' }}</td>
                        <td class="px-4 py-3 border text-center">{{ $discount->discount_percentage }}%</td>
                        <td class="px-4 py-3 border text-center">{{ $discount->start_date }}</td>
                        <td class="px-4 py-3 border text-center">{{ $discount->end_date }}</td>
                        <td class="px-4 py-3 border text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium px-2 py-1 bg-blue-50 rounded hover:bg-blue-100">
                                    Edit
                                </a>
                                <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this discount?')">
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
                        <td colspan="6" class="text-center py-6 text-gray-500 text-lg">
                            No discounts available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

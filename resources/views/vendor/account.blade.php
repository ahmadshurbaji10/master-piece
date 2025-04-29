@extends('layouts.vendor-sidebar')

@section('title', '👤 My Account')
@section('page_title', 'My Account')

@section('content')

<div class="max-w-2xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-8 rounded-xl shadow-md">
        <form method="POST" action="{{ route('vendor.account.update') }}">
            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-semibold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-4 py-2 text-gray-800">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-4 py-2 text-gray-800">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-8">
                <label class="block text-gray-700 text-lg font-semibold mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-4 py-2 text-gray-800">
                @error('phone')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-all duration-300">
                    💾 Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

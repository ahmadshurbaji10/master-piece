@extends('layouts.admin')

@section('content')    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ✏️ Edit User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-base font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                               class="w-full mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="w-full mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-base font-medium text-gray-700">Role</label>
                        <select name="role" id="role"
                                class="w-full mt-1 border border-gray-300 rounded-md shadow-sm px-3 py-2">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="vendor" {{ $user->role === 'vendor' ? 'selected' : '' }}>Vendor</option>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.users.index') }}"
                           class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition mr-2">Cancel</a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            💾 Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

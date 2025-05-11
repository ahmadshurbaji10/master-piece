@extends('layouts.admin')

@section('title', 'Admin | Add User')
@section('page_title', 'Add User')

@section('content')

<!-- 👤 Add User Section -->
<div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">

    <!-- 🔝 Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Add New User</h3>
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

    <!-- 📋 Add Form -->
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Name -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Name</label>
                <input type="text" name="name"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('name') }}" required>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                <input type="email" name="email"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                       value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Role</label>
                <select name="role"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                    <option value="">-- Select Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 mt-6">
            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Save User
            </button>
        </div>
    </form>

</div>

@endsection

@extends('layouts.admin')

@section('title', 'Admin | Manage Users')
@section('page_title', 'Manage Users')

@section('content')

<!-- 👥 Users Management Section -->
<div class="bg-white shadow-md rounded-lg p-6">

    <!-- 🔝 Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">All Users</h3>
        <a href="{{ route('admin.users.create') }}" class="px-5 py-2 bg-green-600 text-white font-semibold text-sm rounded-lg hover:bg-green-700 transition">
            ➕ Add User
        </a>
    </div>

    <!-- 📋 Users Table -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-green-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border text-center">#</th>
                    <th class="px-4 py-3 border">Name</th>
                    <th class="px-4 py-3 border">Email</th>
                    <th class="px-4 py-3 border">Role</th>
                    <th class="px-4 py-3 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border">{{ $user->name }}</td>
                        <td class="px-4 py-3 border">{{ $user->email }}</td>
                        <td class="px-4 py-3 border capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-3 border text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500 text-lg">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

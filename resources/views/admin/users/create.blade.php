@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        ➕ Add New User
    </h2>
</div>

<div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full rounded border-gray-300 focus:ring-green-500 focus:border-green-500" required>
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                {{-- <option value="vendor">Vendor</option> --}}
                <option value="customer">Customer</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 text-sm">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                Save
            </button>
        </div>
    </form>
</div>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ➕ Add New User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Name</label>
                        <input type="text" name="name" class="form-input w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Email</label>
                        <input type="email" name="email" class="form-input w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Password</label>
                        <input type="password" name="password" class="form-input w-full rounded border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Role</label>
                        <select name="role" class="form-select w-full rounded border-gray-300" required>
                            <option value="admin">Admin</option>
                            <option value="vendor">Vendor</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-200 rounded text-gray-700 hover:bg-gray-300">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

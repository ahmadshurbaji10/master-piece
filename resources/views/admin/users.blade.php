<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome message --}}
            <div class="mb-6">
                <div class="bg-white p-6 shadow rounded">
                    <h3 class="text-2xl font-semibold">Welcome Admin 👋</h3>
                    <p class="mt-2 text-gray-600">Here you can manage the whole system.</p>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                {{-- Customers Card --}}
                <div class="bg-blue-100 p-6 rounded-lg shadow">
                    <h4 class="text-lg font-bold text-blue-800 mb-2">Customers</h4>
                    <p class="text-3xl font-extrabold text-blue-900">{{ $customersCount }}</p>
                </div>

                {{-- Vendors Card --}}
                <div class="bg-green-100 p-6 rounded-lg shadow">
                    <h4 class="text-lg font-bold text-green-800 mb-2">Vendors</h4>
                    <p class="text-3xl font-extrabold text-green-900">{{ $vendorsCount }}</p>
                </div>

                {{-- Products Card --}}
                <div class="bg-purple-100 p-6 rounded-lg shadow">
                    <h4 class="text-lg font-bold text-purple-800 mb-2">Products</h4>
                    <p class="text-3xl font-extrabold text-purple-900">{{ $productsCount }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

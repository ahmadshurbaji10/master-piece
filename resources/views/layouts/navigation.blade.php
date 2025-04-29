<div class="hidden space-x-8 sm:flex sm:ml-10">
    @auth
        @if(Auth::user()->role === 'customer')
            <x-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                🏠 Dashboard
            </x-nav-link>
            <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                🛒 Cart
            </x-nav-link>
            <x-nav-link :href="route('checkout.page')" :active="request()->routeIs('checkout.page')">
                ✅ Checkout
            </x-nav-link>
        @elseif(Auth::user()->role === 'admin')
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                🛠️ Admin Dashboard
            </x-nav-link>
            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                👥 Manage Users
            </x-nav-link>
            <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                🧾 Manage Products
            </x-nav-link>
        @elseif(Auth::user()->role === 'vendor')
            <x-nav-link :href="route('vendor.dashboard')" :active="request()->routeIs('vendor.dashboard')">
                🧰 Vendor Dashboard
            </x-nav-link>
        @endif
    @endauth
</div>

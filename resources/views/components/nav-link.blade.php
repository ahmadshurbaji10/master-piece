@if(auth()->user()->role === 'customer')
    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
        🛒 Cart
    </x-nav-link>

    <x-nav-link :href="route('checkout')" :active="request()->routeIs('checkout')">
        ✅ Order Execution
    </x-nav-link>
@endif


<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>


                <div class="flex space-x-4 ml-10 items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    {{-- Pakai array [] atau pipe '|' --}}
                    @role('manager|admin')
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                            Barang
                        </x-nav-link>
                        <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                            Supplier
                        </x-nav-link>
                    @endrole

                    @role('staff_gudang|admin')
                        <x-nav-link :href="route('stock-in.index')" :active="request()->routeIs('stock-in.*')">
                            Stock In
                        </x-nav-link>
                        <x-nav-link :href="route('stock-out.index')" :active="request()->routeIs('stock-out.*')">
                            Stock Out
                        </x-nav-link>
                        <x-nav-link :href="route('stock-opname.index')" :active="request()->routeIs('stock-opname.*')">
                            Stock Opname
                        </x-nav-link>
                    @endrole

                    @role('manager|staff_gudang|admin')
                        <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.*')">
                            History
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" class="ml-4">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

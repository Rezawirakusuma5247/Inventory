<x-app-layout>
    @php
        // Mengambil data secara mandiri agar tidak undefined
        $lowStockProducts = \App\Models\Product::whereRaw('stock <= minimum_stock')->get();
        $totalProducts = \App\Models\Product::count();
        $recentStockIn = \App\Models\StockIn::whereMonth('created_at', now()->month)->count();
        $recentStockOut = \App\Models\StockOut::whereMonth('created_at', now()->month)->count();
        $totalSuppliers = \App\Models\Supplier::count();
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory Overview') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Section -->
            <div class="bg-indigo-700 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-indigo-100 mt-2">Sistem Gudang memantau {{ $totalProducts }} produk dari {{ $totalSuppliers }} supplier hari ini.</p>
                </div>
                <!-- Dekorasi Lingkaran -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-indigo-600 rounded-full opacity-50"></div>
            </div>

            <!-- Urgent Alerts -->
            @if($lowStockProducts->count() > 0)
            <div class="bg-white border-l-8 border-red-600 rounded-xl shadow-md p-6 animate-pulse">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 17c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-black text-red-800">PERHATIAN: STOK KRITIS!</h4>
                        <p class="text-red-700">Ada {{ $lowStockProducts->count() }} produk yang sudah mencapai batas minimum. Segera lakukan re-stock!</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Dashboard Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-blue-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium uppercase">Total Barang</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-green-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium uppercase">In (Bulan Ini)</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $recentStockIn }}</h3>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-orange-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium uppercase">Out (Bulan Ini)</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $recentStockOut }}</h3>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-red-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium uppercase">Stok Kritis</p>
                        <h3 class="text-2xl font-bold text-red-600">{{ $lowStockProducts->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Low Stock Table (Left) -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Daftar Barang Harus Dibeli</h3>
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold uppercase">Urgent</span>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">Produk</th>
                                <th class="px-6 py-3 text-center">Stok Sisa</th>
                                <th class="px-6 py-3 text-center">Batas Aman</th>
                                <th class="px-6 py-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($lowStockProducts->take(5) as $product)
                            <tr>
                                <td class="px-6 py-4 font-semibold">{{ $product->nama_barang }}</td>
                                <td class="px-6 py-4 text-center text-red-600 font-bold font-mono">{{ $product->stock }}</td>
                                <td class="px-6 py-4 text-center text-gray-400">{{ $product->minimum_stock }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('stock-in.create') }}" class="text-indigo-600 hover:underline font-bold text-xs">+ Isi Stok</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Quick Actions (Right) -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm mb-6 border-b pb-4">Akses Cepat</h3>
                    <div class="space-y-4">
                        <a href="{{ route('stock-in.create') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition group">
                            <span class="text-2xl mr-4 group-hover:scale-125 transition"></span>
                            <span class="font-bold text-green-800">Input Barang Masuk</span>
                        </a>
                        <a href="{{ route('stock-out.create') }}" class="flex items-center p-4 bg-red-50 hover:bg-red-100 rounded-xl transition group">
                            <span class="text-2xl mr-4 group-hover:scale-125 transition"></span>
                            <span class="font-bold text-red-800">Catat Barang Keluar</span>
                        </a>
                        <a href="{{ route('stock-opname.create') }}" class="flex items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition group">
                            <span class="text-2xl mr-4 group-hover:scale-125 transition"></span>
                            <span class="font-bold text-orange-800">Stock Opname</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

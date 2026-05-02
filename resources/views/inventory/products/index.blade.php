<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Master Data Barang') }}
            </h2>

            <div class="flex gap-2">
                <!-- Tombol Export (Opsional) -->
                <a href="{{ route('export.products') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow">
                    Export Excel
                </a>

                @role('admin')
                <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow">
                    + Tambah Barang Baru
                </a>
                @endrole
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Flash Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="px-4 py-3">Nama Barang</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Stok Saat Ini</th>
                                <th class="px-4 py-3">Harga Jual</th>
                                <th class="px-4 py-3">Supplier Utama</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 font-mono text-indigo-600 font-bold">{{ $product->kode_barang }}</td>
                                <td class="px-4 py-4 font-medium text-gray-900">{{ $product->nama_barang }}</td>
                                <td class="px-4 py-4">{{ $product->kategori }}</td>
                                <td class="px-4 py-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $product->stock <= $product->minimum_stock ? 'bg-red-100 text-red-700 animate-pulse' : 'bg-green-100 text-green-700' }}">
                                        {{ $product->stock }} {{ $product->satuan }}
                                    </span>
                                    @if($product->stock <= $product->minimum_stock)
                                        <p class="text-[10px] text-red-500 mt-1 font-bold">⚠️ Re-stock segera!</p>
                                    @endif
                                </td>
                                <td class="px-4 py-4">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-4 py-4 text-xs">{{ $product->supplier->nama_supplier }}</td>
                                <td class="px-4 py-4 text-center">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 font-bold">Edit</a>
                                        @role('admin')
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                        </form>
                                        @endrole
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center italic text-gray-400">Belum ada data barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

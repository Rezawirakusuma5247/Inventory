<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Stock In</h2>
            <a href="{{ route('stock-in.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow">
                + Input Barang Masuk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 uppercase font-bold">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Barang</th>
                            <th class="px-4 py-3">Supplier</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($stockIns as $item)
                        <tr>
                            <td class="px-4 py-4">{{ $item->tanggal_masuk }}</td>
                            <td class="px-4 py-4 font-bold">{{ $item->product->nama_barang }}</td>
                            <td class="px-4 py-4">{{ $item->supplier->nama_supplier }}</td>
                            <td class="px-4 py-4 text-green-600 font-bold">+ {{ $item->qty }}</td>
                            <td class="px-4 py-4 text-xs">{{ $item->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $stockIns->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>

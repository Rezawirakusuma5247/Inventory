<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-xl text-gray-800 leading-tight">
                    Audit Trail / Riwayat Transaksi
                </h2>
                <a href="{{ route('export.history') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-bold shadow transition">
                    <i class="ph ph-file-xls text-lg"></i> Export Excel
                </a>
            </div>
        </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-800 text-white uppercase italic">
                        <tr>
                            <th class="p-4 text-left">Waktu</th>
                            <th class="p-4 text-left">Admin</th>
                            <th class="p-4 text-left">Barang</th>
                            <th class="p-4 text-left">Tipe</th>
                            <th class="p-4 text-center">Qty</th>
                            <th class="p-4 text-center">Before</th>
                            <th class="p-4 text-center text-yellow-400">After</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($histories as $h)
                        <tr>
                            <td class="p-4">{{ $h->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-4">{{ $h->user?->name ?? 'System/Deleted User' }}</td>
                            <td class="p-4 font-bold">{{ $h->product->nama_barang }}</td>
                            <td class="p-4 italic text-gray-600">{{ $h->type }}</td>
                            <td class="p-4 text-center font-bold">{{ $h->qty }}</td>
                            <td class="p-4 text-center text-gray-500">{{ $h->before_stock }}</td>
                            <td class="p-4 text-center font-bold text-indigo-700 bg-indigo-50">{{ $h->after_stock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">{{ $histories->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>

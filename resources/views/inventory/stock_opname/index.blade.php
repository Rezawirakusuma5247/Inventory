<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Stock Opname (Penyesuaian Stok)') }}
            </h2>

            <div class="flex gap-2">
                <!-- Tombol Export (Opsional) -->
                <a href="{{ route('export.products') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow">
                    Export Excel
                </a>

                @role(['admin', 'staff_gudang'])
                <a href="{{ route('stock-opname.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow transition">
                    + Mulai Cek Fisik Baru
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 font-bold">
                            <tr>
                                <th class="px-6 py-3">Tanggal Opname</th>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3 text-center">Stok Sistem</th>
                                <th class="px-6 py-3 text-center">Stok Fisik</th>
                                <th class="px-6 py-3 text-center">Selisih</th>
                                <th class="px-6 py-3">Disetujui Oleh</th>
                                <th class="px-6 py-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($opnames as $opname)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($opname->tanggal_opname)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $opname->product->nama_barang }}
                                </td>
                                <td class="px-6 py-4 text-center font-mono">
                                    {{ $opname->stock_system }}
                                </td>
                                <td class="px-6 py-4 text-center font-mono font-bold text-blue-600">
                                    {{ $opname->stock_fisik }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($opname->selisih > 0)
                                        <span class="text-green-600 font-bold">+{{ $opname->selisih }}</span>
                                    @elseif($opname->selisih < 0)
                                        <span class="text-red-600 font-bold">{{ $opname->selisih }}</span>
                                    @else
                                        <span class="text-gray-400 font-bold">0</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs font-semibold uppercase">
                                    {{ $opname->user->name }}
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    {{ $opname->keterangan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400 italic">
                                    Belum pernah dilakukan stock opname.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $opnames->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

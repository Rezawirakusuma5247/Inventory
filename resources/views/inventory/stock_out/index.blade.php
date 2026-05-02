<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Barang Keluar (Stock Out)') }}
            </h2>
            @role(['admin', 'staff_gudang'])
            <a href="{{ route('stock-out.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow transition">
                + Catat Barang Keluar
            </a>
            @endrole
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
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-bold">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3">Qty Keluar</th>
                                <th class="px-6 py-3">Tujuan/Keperluan</th>
                                <th class="px-6 py-3">Petugas (PIC)</th>
                                <th class="px-6 py-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($stockOuts as $out)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($out->tanggal_keluar)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $out->product->nama_barang }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-red-600 font-bold">- {{ $out->qty }} {{ $out->product->satuan }}</span>
                                </td>
                                <td class="px-6 py-4 uppercase text-xs font-semibold">
                                    {{ $out->tujuan }}
                                </td>
                                <td class="px-6 py-4 text-xs italic">
                                    {{ $out->user->name }}
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    {{ $out->keterangan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">
                                    Belum ada data barang keluar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $stockOuts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

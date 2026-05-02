<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Input Barang Keluar</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow rounded-lg border-t-4 border-red-500">
                <form action="{{ route('stock-out.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-input-label value="Pilih Barang" />
                            <select name="product_id" id="product_id" class="w-full border-gray-300 rounded-md shadow-sm select2">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-stock="{{ $product->stock }}">
                                        {{ $product->nama_barang }} (Tersedia: {{ $product->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label value="Jumlah Keluar" />
                                <x-text-input type="number" name="qty" class="w-full mt-1" required min="1" />
                            </div>
                            <div>
                                <x-input-label value="Tanggal" />
                                <x-text-input type="date" name="tanggal_keluar" class="w-full mt-1" value="{{ date('Y-m-d') }}" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label value="Tujuan / Keperluan" />
                            <x-text-input name="tujuan" class="w-full mt-1" placeholder="Contoh: Penjualan, Rusak, atau Project A" required />
                        </div>

                        <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700">
                            Catat Barang Keluar
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

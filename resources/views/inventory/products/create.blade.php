<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftarkan Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kode Barang -->
                        <div>
                            <x-input-label for="kode_barang" value="Kode Barang (SKU)" />
                            <x-text-input id="kode_barang" name="kode_barang" type="text" class="mt-1 block w-full uppercase" placeholder="CONTOH: BRG-001" required />
                            <x-input-error :messages="$errors->get('kode_barang')" class="mt-2" />
                        </div>

                        <!-- Nama Barang -->
                        <div>
                            <x-input-label for="nama_barang" value="Nama Barang" />
                            <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full" required />
                        </div>

                        <!-- Kategori & Satuan -->
                        <div>
                            <x-input-label for="kategori" value="Kategori" />
                            <x-text-input id="kategori" name="kategori" type="text" class="mt-1 block w-full" placeholder="Elektronik, Food, dll" required />
                        </div>
                        <div>
                            <x-input-label for="satuan" value="Satuan" />
                            <select name="satuan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                                <option value="Pcs">Pcs</option>
                                <option value="Box">Box</option>
                                <option value="Kg">Kg</option>
                                <option value="roll">Roll</option>
                                <option value="Unit">Unit</option>
                            </select>
                        </div>

                        <!-- Stok Minimum & Supplier -->
                        <div>
                            <x-input-label for="minimum_stock" value="Limit Stok Minimum (Alert)" />
                            <x-text-input id="minimum_stock" name="minimum_stock" type="number" class="mt-1 block w-full" value="5" required />
                        </div>
                        <div>
                            <x-input-label for="supplier_id" value="Supplier Utama" />
                            <select name="supplier_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga -->
                        <div>
                            <x-input-label for="harga_beli" value="Harga Beli" />
                            <x-text-input id="harga_beli" name="harga_beli" type="number" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="harga_jual" value="Harga Jual" />
                            <x-text-input id="harga_jual" name="harga_jual" type="number" class="mt-1 block w-full" required />
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <x-input-label for="status" value="Status Produk" />
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="active">Active (Tersedia untuk transaksi)</option>
                                <option value="inactive">Inactive (Arsip)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-6">
                        <a href="{{ route('products.index') }}" class="mr-4 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button class="bg-indigo-600"> Simpan Produk </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

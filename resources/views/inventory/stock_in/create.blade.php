<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight font-bold">Form Stock In</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm rounded-lg">
                <form action="{{ route('stock-in.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <x-input-label for="product_id" value="Pilih Barang" />
                            <select name="product_id" class="w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_barang }} (Sisa: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="supplier_id" value="Pilih Supplier" />
                            <select name="supplier_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="qty" value="Jumlah Masuk" />
                                <x-text-input type="number" name="qty" class="w-full mt-1" required />
                            </div>
                            <div>
                                <x-input-label for="tanggal_masuk" value="Tanggal Masuk" />
                                <x-text-input type="date" name="tanggal_masuk" class="w-full mt-1" value="{{ date('Y-m-d') }}" required />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="keterangan" value="Keterangan" />
                            <textarea name="keterangan" class="w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                        </div>
                        <x-primary-button class="justify-center py-3">Simpan Stock Masuk</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

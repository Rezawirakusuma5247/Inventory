<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-orange-500">
            <h2 class="text-xl font-bold mb-4">Stock Opname (Cek Fisik)</h2>
            <p class="text-sm text-gray-600 mb-6 italic">*Gunakan fitur ini untuk menyesuaikan stok sistem dengan stok nyata di gudang.</p>

            <form action="{{ route('stock-opname.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block font-bold">Pilih Barang</label>
                        <select name="product_id" class="w-full rounded border-gray-300">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->nama_barang }} (Sistem: {{ $product->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold">Jumlah Fisik yang Ditemukan</label>
                        <x-text-input type="number" name="stock_fisik" class="w-full" placeholder="Masukkan jumlah asli di gudang" required />
                    </div>
                    <div>
                        <label class="block font-bold">Alasan Perubahan</label>
                        <textarea name="keterangan" class="w-full border-gray-300 rounded" placeholder="Contoh: Barang rusak / Hilang / Salah input"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg font-bold hover:bg-orange-700 transition">
                        Update & Sinkronkan Stok
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

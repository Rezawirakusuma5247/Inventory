<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk: {{ $product->nama_barang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow rounded-lg">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label value="Nama Barang" />
                            <x-text-input name="nama_barang" type="text" class="mt-1 block w-full" :value="old('nama_barang', $product->nama_barang)" required />
                        </div>
                        <div>
                            <x-input-label value="Kategori" />
                            <x-text-input name="kategori" type="text" class="mt-1 block w-full" :value="old('kategori', $product->kategori)" required />
                        </div>
                        <div>
                            <x-input-label value="Minimum Stock" />
                            <x-text-input name="minimum_stock" type="number" class="mt-1 block w-full" :value="old('minimum_stock', $product->minimum_stock)" required />
                        </div>
                        <div>
                            <x-input-label value="Status" />
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <!-- Tambahkan field lainnya sesuai kebutuhan -->
                    </div>

                    <div class="mt-8">
                        <x-primary-button>Perbarui Data Barang</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

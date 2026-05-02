<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Supplier Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <x-input-label for="nama_supplier" value="Nama Perusahaan/Supplier" />
                            <x-text-input id="nama_supplier" name="nama_supplier" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error :messages="$errors->get('nama_supplier')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="pic" value="Nama PIC (Person In Charge)" />
                                <x-text-input id="pic" name="pic" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <x-input-label for="no_telp" value="Nomor Telepon" />
                                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="alamat" value="Alamat Lengkap" />
                            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3"></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('suppliers.index') }}" class="mr-4 text-sm text-gray-600 hover:underline">Batal</a>
                            <x-primary-button> Simpan Supplier </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

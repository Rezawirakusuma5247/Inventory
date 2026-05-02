<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Supplier: {{ $supplier->nama_supplier }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="nama_supplier" value="Nama Supplier" />
                            <x-text-input name="nama_supplier" type="text" class="mt-1 block w-full" :value="old('nama_supplier', $supplier->nama_supplier)" required />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label value="PIC" />
                                <x-text-input name="pic" type="text" class="mt-1 block w-full" :value="old('pic', $supplier->pic)" required />
                            </div>
                            <div>
                                <x-input-label value="No. Telp" />
                                <x-text-input name="no_telp" type="text" class="mt-1 block w-full" :value="old('no_telp', $supplier->no_telp)" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button> Update Data </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

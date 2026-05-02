<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with('supplier')->get();
    }

    public function headings(): array
    {
        return ['Kode', 'Nama Barang', 'Kategori', 'Stok', 'Stok Min', 'Harga Jual', 'Supplier'];
    }

    public function map($product): array
    {
        return [
            $product->kode_barang,
            $product->nama_barang,
            $product->kategori,
            $product->stock,
            $product->minimum_stock,
            $product->harga_jual,
            $product->supplier?->nama_supplier,
        ];
    }
}

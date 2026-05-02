<?php

namespace App\Exports;

use App\Models\StockOpname;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockOpnameExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return StockOpname::with(['product', 'user'])->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Barang', 'Stok Sistem', 'Stok Fisik', 'Selisih', 'Keterangan', 'Petugas'];
    }

    public function map($opname): array
    {
        return [
            $opname->tanggal_opname,
            $opname->product?->nama_barang,
            $opname->stock_system,
            $opname->stock_fisik,
            $opname->selisih,
            $opname->keterangan,
            $opname->user?->name,
        ];
    }
}

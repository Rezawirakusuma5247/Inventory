<?php

namespace App\Exports;

use App\Models\TransactionHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionHistoryExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return TransactionHistory::with(['product', 'user'])->latest()->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Barang', 'Tipe', 'Jumlah', 'Stok Lama', 'Stok Baru', 'Oleh'];
    }

    public function map($history): array
    {
        return [
            $history->created_at->format('d-m-Y H:i'),
            $history->product?->nama_barang,
            $history->transaction_type,
            $history->quantity,
            $history->old_stock,
            $history->new_stock,
            $history->user?->name,
        ];
    }
}

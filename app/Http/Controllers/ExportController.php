<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\TransactionHistoryExport;
use App\Exports\StockOpnameExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportProducts() {
        return Excel::download(new ProductsExport, 'master-barang.xlsx');
    }

    public function exportHistory() {
        return Excel::download(new TransactionHistoryExport, 'history-transaksi.xlsx');
    }

    public function exportOpname() {
        return Excel::download(new StockOpnameExport, 'laporan-opname.xlsx');
    }
}

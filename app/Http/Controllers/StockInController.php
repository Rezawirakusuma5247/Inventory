<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockIn;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockInController extends Controller
{
    // READ: Menampilkan daftar riwayat barang masuk
    public function index()
    {
        $stockIns = StockIn::with(['product', 'supplier', 'user'])->latest()->paginate(10);
        return view('inventory.stock_in.index', compact('stockIns'));
    }

    // CREATE: Form tambah stok
    public function create()
    {
        $products = Product::where('status', 'active')->get();
        $suppliers = Supplier::all();
        return view('inventory.stock_in.create', compact('products', 'suppliers'));
    }

    // STORE: Proses eksekusi Service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'qty' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $stockIn = StockIn::create(array_merge($validated, [
            'created_by' => Auth::id()
        ]));

        // Trigger perubahan stok di Master Product & History
        StockService::updateStock(
            $validated['product_id'],
            $validated['qty'],
            'IN',
            $stockIn->id
        );

        return redirect()->route('stock-in.index')->with('success', 'Stok berhasil masuk dan tercatat.');
    }
}

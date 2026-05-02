<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOut;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['product', 'user'])->latest()->paginate(10);
        return view('inventory.stock_out.index', compact('stockOuts'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('inventory.stock_out.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->qty) {
            return back()->with('error', "Stok tidak cukup! Sisa: {$product->stock}");
        }

        $stockOut = StockOut::create([
            'product_id'     => $request->product_id,
            'qty'            => $request->qty,
            'tanggal_keluar' => $request->tanggal_keluar,
            'tujuan'         => $request->tujuan,
            'keterangan'     => $request->keterangan,
            'created_by'     => Auth::id(), // Gunakan Auth::id() agar konsisten
        ]);

        // PAKAI SERVICE: Agar tercatat di History secara otomatis
        \App\Services\StockService::updateStock(
            $product->id,
            $request->qty,
            'OUT',
            $stockOut->id
        );

        return redirect()->route('stock-out.index')->with('success', 'Barang keluar berhasil dicatat.');
    }
}

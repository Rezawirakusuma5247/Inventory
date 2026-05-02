<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOpnameController extends Controller
{
    public function index()
    {
        $opnames = StockOpname::with(['product', 'user'])->latest()->paginate(10);
        return view('inventory.stock_opname.index', compact('opnames'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory.stock_opname.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_fisik' => 'required|integer|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);
        $selisih = $request->stock_fisik - $product->stock;

        $opname = StockOpname::create([
            'product_id' => $product->id,
            'stock_system' => $product->stock,
            'stock_fisik' => $request->stock_fisik,
            'selisih' => $selisih,
            'tanggal_opname' => now(),
            'keterangan' => $request->keterangan,
            'approved_by' => Auth::id(),
        ]);

        // "OPNAME" di Service akan memaksa stok menjadi nilai fisik yang diinput
        StockService::updateStock($product->id, $request->stock_fisik, 'OPNAME', $opname->id);

        return redirect()->route('stock-opname.index')->with('success', 'Stock Opname selesai, stok telah disesuaikan.');
    }
}

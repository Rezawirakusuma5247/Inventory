<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data produk beserta relasi suppliernya
        $products = Product::with('supplier')->latest()->paginate(10);

        // Logic Alert: Hitung produk yang stoknya <= minimum_stock
        $lowStockCount = Product::whereRaw('stock <= minimum_stock')->count();

        return view('inventory.products.index', compact('products', 'lowStockCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('inventory.products.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang'   => 'required|string|unique:products,kode_barang',
            'nama_barang'   => 'required|string|max:255',
            'kategori'      => 'required|string',
            'satuan'        => 'required|string',
            'minimum_stock' => 'required|integer|min:0',
            'harga_beli'    => 'required|numeric|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'supplier_id'   => 'required|exists:suppliers,id',
            'status'        => 'required|in:active,inactive',
        ]);

        // Default stock saat pertama kali buat adalah 0 (nanti diisi via Stock In)
        Product::create(array_merge($validated, ['stock' => 0]));

        return redirect()->route('products.index')
            ->with('success', 'Produk baru berhasil didaftarkan ke sistem.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Memuat history transaksi khusus produk ini
        $product->load(['supplier', 'histories.user']);
        return view('inventory.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('inventory.products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'kode_barang'   => 'required|string|unique:products,kode_barang,' . $product->id,
            'nama_barang'   => 'required|string|max:255',
            'kategori'      => 'required|string',
            'satuan'        => 'required|string',
            'minimum_stock' => 'required|integer|min:0',
            'harga_beli'    => 'required|numeric|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'supplier_id'   => 'required|exists:suppliers,id',
            'status'        => 'required|in:active,inactive',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Cek apakah produk sudah punya histori transaksi
        if ($product->histories()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Produk tidak bisa dihapus karena sudah memiliki riwayat transaksi (Gunakan status Inactive saja).');
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus dari database.');
    }
}

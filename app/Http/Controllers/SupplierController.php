<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        $suppliers = Supplier::all();
        return view('inventory.suppliers.index', compact('suppliers'));
    }

    public function create() {
        return view('inventory.suppliers.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_telp' => 'required|string',
            'email' => 'required|email|unique:suppliers',
            'pic' => 'required|string',
            'alamat' => 'nullable'
        ]);

        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambah');
    }

    public function edit(Supplier $supplier) {
        return view('inventory.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier) {
        $validated = $request->validate([
            'nama_supplier' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:suppliers,email,'.$supplier->id,
            'pic' => 'required',
        ]);

        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier diupdate');
    }

    public function destroy(Supplier $supplier) {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier dihapus');
    }
}

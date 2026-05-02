<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $products = [
        [
            'kode_barang' => 'BRG001',
            'nama_barang' => 'SSD Samsung 980 Pro 1TB',
            'kategori' => 'Hardware',
            'satuan' => 'Pcs',
            'minimum_stock' => 5,
            'harga_beli' => 1200000,
            'harga_jual' => 1500000,
            'supplier_id' => 1,
            'stock' => 50, // Stok awal
            'status' => 'active'
        ],
        [
            'kode_barang' => 'BRG002',
            'nama_barang' => 'Keyboard Mechanical RGB',
            'kategori' => 'Aksesoris',
            'satuan' => 'Pcs',
            'minimum_stock' => 5,
            'harga_beli' => 395000,
            'harga_jual' => 450000,
            'supplier_id' => 2,
            'stock' => 50, // Stok awal
            'status' => 'active'
        ],
    ];

    foreach ($products as $p) {
        \App\Models\Product::create($p);
    }
}
}

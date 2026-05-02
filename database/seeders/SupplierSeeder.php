<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ['nama_supplier' => 'PT. Sentosa Komputer ( Distributor Hardware & Sparepart )', 'no_telp' => '081233445566', 'email' => 'info@sentosa.com', 'pic' => 'Budi', 'alamat' => 'Jakarta'],
            ['nama_supplier' => 'Global Tech Indo ( Importir Aksesoris Gadget )', 'no_telp' => '081199887766', 'email' => 'GlobalTech@gmail.com', 'pic' => 'Ani', 'alamat' => 'Bandung'],
        ];

        foreach ($suppliers as $s) {
            \App\Models\Supplier::create($s);
        }
    }
}

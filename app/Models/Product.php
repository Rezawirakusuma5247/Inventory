<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['kode_barang', 'nama_barang', 'kategori', 'satuan', 'stock', 'minimum_stock', 'harga_beli', 'harga_jual', 'supplier_id', 'status'];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

        public static function getLowStock()
    {
        return self::whereRaw('stock <= minimum_stock')->get();
    }

    
}

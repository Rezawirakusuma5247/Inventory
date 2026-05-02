<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $fillable = [
        'product_id',
        'qty',
        'tanggal_keluar',
        'tujuan',
        'keterangan',
        'created_by'
    ];

    // Relasi ke Produk (Wajib agar bisa menampilkan nama barang)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke User (Wajib agar Controller baris 15 tidak error)
    public function user()
    {
        // Kita arahkan created_by ke Model User
        return $this->belongsTo(User::class, 'created_by');
    }
}

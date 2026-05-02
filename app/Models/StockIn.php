<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'qty', 'tanggal_masuk', 'keterangan', 'created_by'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // TAMBAHKAN INI
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

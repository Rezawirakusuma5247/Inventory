<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $fillable = [
        'product_id',
        'stock_system',
        'stock_fisik',
        'selisih',
        'tanggal_opname',
        'keterangan',
        'approved_by' // Ini biasanya ID user
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        // Mengarahkan ke User menggunakan foreign key 'approved_by'
        return $this->belongsTo(User::class, 'approved_by');
    }
}

<?php

namespace App\Services;

use App\Models\Product;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockService
{
    /**
     * Update stock dan catat history secara atomik.
     */
    public static function updateStock(int $productId, int $qty, string $type, int $referenceId)
    {
        return DB::transaction(function () use ($productId, $qty, $type, $referenceId) {
            $product = Product::lockForUpdate()->find($productId);
            $before = $product->stock;

            // Logika penambahan/pengurangan
            if ($type === 'IN') {
                $product->stock += $qty;
            } elseif ($type === 'OUT') {
                $product->stock -= $qty;
            } elseif ($type === 'OPNAME') {
                // Untuk opname, qty yang dikirim adalah stock_fisik
                $product->stock = $qty;
            }

            $product->save();

            // Catat ke Transaction Histories
            return TransactionHistory::create([
                'product_id'       => $productId,
                'user_id'          => Auth::id(), // Sesuaikan dengan Model (sebelumnya user_id)
                'transaction_type' => $type,      // Sesuaikan dengan Model (sebelumnya transaction_type)
                'quantity'         => $qty,       // Sesuaikan dengan Model (sebelumnya quantity)
                'old_stock'        => $before,    // Sesuaikan dengan Model (sebelumnya old_stock)
                'new_stock'        => $product->stock, // Sesuaikan dengan Model (sebelumnya new_stock)
                'description'      => "Transaksi $type sebesar $qty", // Tambahan jika ada di fillable
                'reference_id'     => $referenceId,
            ]);
        });
    }
}

<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\TransactionHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $lowStockProducts = \App\Models\Product::whereRaw('stock <= minimum_stock')->get();
    return view('dashboard', compact('lowStockProducts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);

    Route::get('/stock-in', [StockInController::class, 'index'])->name('stock-in.index');
    Route::get('/stock-in/create', [StockInController::class, 'create'])->name('stock-in.create');
    Route::post('/stock-in', [StockInController::class, 'store'])->name('stock-in.store');

    Route::get('/stock-out', [StockOutController::class, 'index'])->name('stock-out.index');
    Route::get('/stock-out/create', [StockOutController::class, 'create'])->name('stock-out.create');
    Route::post('/stock-out', [StockOutController::class, 'store'])->name('stock-out.store');

    Route::get('/stock-opname', [StockOpnameController::class, 'index'])->name('stock-opname.index');
    Route::get('/stock-opname/create', [StockOpnameController::class, 'create'])->name('stock-opname.create');
    Route::post('/stock-opname', [StockOpnameController::class, 'store'])->name('stock-opname.store');

    Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('history.index');

    Route::get('/export/products', [ExportController::class, 'exportProducts'])->name('export.products');
    Route::get('/export/history', [ExportController::class, 'exportHistory'])->name('export.history');
    Route::get('/export/opname', [ExportController::class, 'exportOpname'])->name('export.opname');
});


require __DIR__.'/auth.php';

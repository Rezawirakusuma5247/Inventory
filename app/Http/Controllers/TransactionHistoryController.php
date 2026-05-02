<?php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;

class TransactionHistoryController extends Controller
{
    public function index() {
        $histories = TransactionHistory::with(['product', 'user'])->latest()->paginate(20);
        return view('inventory.histories.index', compact('histories'));
    }
}

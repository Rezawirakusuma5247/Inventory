<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_histories', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->enum('type', ['IN', 'OUT', 'OPNAME']);
            $table->integer('qty');
            $table->integer('before_stock');
            $table->integer('after_stock');
            $table->unsignedBigInteger('reference_id'); // ID dari tabel IN/OUT/OPNAME
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};

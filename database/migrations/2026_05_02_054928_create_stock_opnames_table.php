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
        Schema::create('stock_opnames', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->integer('stock_system');
            $table->integer('stock_fisik');
            $table->integer('selisih');
            $table->date('tanggal_opname');
            $table->text('keterangan')->nullable();
            $table->foreignId('approved_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_opnames');
    }
};

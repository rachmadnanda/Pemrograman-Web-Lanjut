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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id'); // [cite: 197]
            $table->unsignedBigInteger('penjualan_id')->index(); // [cite: 198]
            $table->unsignedBigInteger('barang_id')->index(); // [cite: 198]
            $table->integer('harga'); // [cite: 202]
            $table->integer('jumlah'); // [cite: 206]
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};

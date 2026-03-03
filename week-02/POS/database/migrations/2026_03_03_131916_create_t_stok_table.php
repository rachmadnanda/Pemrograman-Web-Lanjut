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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id'); // [cite: 187]
            $table->unsignedBigInteger('supplier_id')->index(); // [cite: 191]
            $table->unsignedBigInteger('barang_id')->index(); // [cite: 193]
            $table->unsignedBigInteger('user_id')->index(); // [cite: 201]
            $table->dateTime('stok_tanggal'); // [cite: 207]
            $table->integer('stok_jumlah'); // [cite: 209]
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('supplier_id')->references('supplier_id')->on('m_supplier');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};

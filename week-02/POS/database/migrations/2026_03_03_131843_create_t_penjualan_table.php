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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id'); // [cite: 220]
            $table->unsignedBigInteger('user_id')->index(); // [cite: 227]
            $table->string('pembeli', 50); // [cite: 232]
            $table->string('penjualan_kode', 20)->unique(); // [cite: 235]
            $table->dateTime('penjualan_tanggal'); // [cite: 241]
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};

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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksis')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('pmb_id');
            $table->foreign('pmb_id')->references('id')->on('pembayarans')->onUpdate('cascade')->onDelete('restrict');
            $table->string('jumlah',100);
            $table->string('harga_satuan',100);
            $table->string('kembalian',100);
            $table->string('diskon',100);
            $table->string('subtotal',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};

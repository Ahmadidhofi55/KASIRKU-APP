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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('qr_produk',100);
            $table->string('qr_img',100);
            $table->string('img',100);
            $table->unsignedBigInteger('supliyer_id');
            $table->foreign('supliyer_id')->references('id')->on('supliyers')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('merek_id');
            $table->foreign('merek_id')->references('id')->on('mereks')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('jenis_id');
            $table->foreign('jenis_id')->references('id')->on('mereks')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('stok',15,2);
            $table->decimal('harga_beli',15,2);
            $table->decimal('harga_jual',15,2);
            $table->decimal('diskon', 15, 2)->nullable(); // Diskon dapat null
            $table->date('tgl_exp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

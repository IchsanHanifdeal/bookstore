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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->unsignedBigInteger('pengarang');
            $table->unsignedBigInteger('penerbit');
            $table->unsignedBigInteger('kategori');
            $table->integer('stok');
            $table->integer('harga');
            $table->string('deskripsi');
            $table->string('gambar')->nullable();
            $table->foreign('pengarang')->references('id')->on('pengarangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penerbit')->references('id')->on('penerbits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kategori')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};

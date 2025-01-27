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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer');
            $table->unsignedBigInteger('buku');
            $table->integer('jumlah');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('customer')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buku')->references('id')->on('bukus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};

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
        Schema::create('baddebts', function (Blueprint $table) {
            $table->id();
            $table->string('idPelanggan');
            $table->string('idPelangganProduk');
            $table->string('idCRM');
            $table->string('idPLN');
            $table->string('typebilling');
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->string('telepon');
            $table->dateTime('periodeIsolir');
            $table->integer('telatHari');
            $table->dateTime('tanggalAktivasi');
            $table->string('namaLayananProduk');
            $table->float('rp_produk');
            $table->string('kodeGerak');
            $table->string('statusAktif');
            $table->string('namaSBU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baddebt');
    }
};

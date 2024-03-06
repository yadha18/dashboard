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
        Schema::create('pelanggan_deaktivasis', function (Blueprint $table) {
            $table->id();
            $table->string('idPelanggan');
            $table->string('idPelangganProduk');
            $table->string('idLayanan');
            $table->string('idLayananProduk');
            $table->string('nama');
            $table->string('namaLayanan');
            $table->string('namaLayananProduk');
            $table->string('tipeBilling');
            $table->string('nomorVA');
            $table->string('billingAlamat')->nullable();
            $table->string('terminatingAlamat')->nullable();
            $table->dateTime('tanggalAktivasi');
            $table->dateTime('tanggalDeaktivasi')->nullable();
            $table->dateTime('tanggalStartBilling');
            $table->dateTime('tanggalMutasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan_deaktivasis');
    }
};

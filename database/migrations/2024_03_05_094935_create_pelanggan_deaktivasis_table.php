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
            $table->string('namaLayanan')->nullable();
            $table->string('namaLayananProduk')->nullable();
            $table->string('tipeBilling');
            $table->string('nomorVA');
            $table->string('namaSBU');
            $table->string('billingAlamat')->nullable();
            $table->string('terminatingAlamat')->nullable();
            $table->dateTime('tanggalAktivasi')->nullable();
            $table->dateTime('tanggalDeaktivasi')->nullable();
            $table->dateTime('tanggalStartBilling')->nullable();
            $table->dateTime('tanggalMutasi')->nullable();
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

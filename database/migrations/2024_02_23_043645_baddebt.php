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
            $table->string('namaLayanan');
            $table->string('namaLayananProduk');
            $table->string('tanggalAktivasi');
            $table->string('tahunBulanAktivasi');
            $table->string('tanggalTagihan');
            $table->string('tahunBulanTagihan');
            $table->string('tanggalIsolir');
            $table->integer('telatHari');
            $table->integer('prepaid');
            $table->string('namaSBU');
            $table->string('namaKP');
            $table->string('salesInput');
            $table->integer('totalTiket');
            $table->string('Promo');
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

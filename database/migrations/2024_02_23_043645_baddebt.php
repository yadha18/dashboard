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
            $table->string('nama');
            $table->string('no_telp');
            $table->string('email');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('tipeBilling');
            $table->string('namaLayanan');
            $table->string('namaLayananProduk');
            $table->string('namaSBU');
            $table->string('namaKP');
            $table->string('oltId');
            $table->string('splitterId');
            $table->string('ontId');
            $table->string('ontSerialNumber');
            $table->dateTime('tanggalAktivasi');
            $table->integer('durasi');
            $table->string('lama_durasi');
            $table->integer('month');
            $table->integer('year');
            $table->string('status_winback');
            $table->string('status');
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

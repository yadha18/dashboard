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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->integer('idTagihan');
            $table->float('pendapatan');
            $table->dateTime('tanggalBayar')->nullable();
            $table->dateTime('tanggalTagihan')->nullable();
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('namaLayanan')->nullable();
            $table->string('namaLayananProduk')->nullable();
            $table->string('typeBilling');
            $table->string('namaKP');
            $table->string('namaSBU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};

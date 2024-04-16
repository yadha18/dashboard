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
        Schema::create('revenue_account_executives', function (Blueprint $table) {
            $table->id();
            $table->string('idPermohonan');
            $table->string('salesInput');
            $table->string('uplineSales')->nullable();
            $table->string('mitraSales');
            $table->string('mitraUpline')->nullable();
            $table->dateTime('tanggalAktivasi')->nullable();
            $table->string('namaLayanan')->nullable();
            $table->string('namaProduk')->nullable();
            $table->float('rpProduk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_account_executives');
    }
};

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
        Schema::create('kanal_bayars', function (Blueprint $table) {
            $table->id();
            $table->string("idPelanggan")->nullable();
            $table->biginteger("idTagihan")->nullable();
            $table->dateTime("tanggalBayar")->nullable();
            $table->float("rpTagihanMinusPPN")->nullable();
            $table->string("pembayaranVia")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kanal_bayars');
    }
};

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
        Schema::create('h_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('idPelanggan');
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->dateTime('tanggalAktivasi');
            $table->string('namaSBU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_c_s');
    }
};

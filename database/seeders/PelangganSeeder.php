<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::createFromFormat('Y-m-d', '2024-01-01');
        $endDate = Carbon::now();
        $daysDifference = $startDate->diffInDays($endDate);
        $namaSBUs = ['SBU', 'SBTG', 'SBS', 'JBB', 'JBTG', 'JBT', 'KAL', 'SIT', 'BNT', 'JKB'];

        for ($i = 1; $i <= 10000; $i++) {
            $randomDate = $startDate->copy()->addDays(rand(0, $daysDifference))->format('Y-m-d H:i:s');
            DB::table('h_c_s')->insert([
                'idPelanggan' => 'A' . sprintf('%03d', $i),
                'nama' => 'Pelanggan ' . $i,
                'alamat' => 'Alamat Pelanggan ' . $i,
                'tanggalAktivasi' => $randomDate,
                'namaSBU' => $namaSBUs[array_rand($namaSBUs)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

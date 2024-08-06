<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class revenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::createFromFormat('Y-m-d', '2024-01-01');
        $endDate = Carbon::now();
        $daysDifference = $startDate->diffInDays($endDate);
        $layananData = [];
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $years = [2020, 2021, 2022, 2023, 2024];
        $product = ['10 MBPS', '20 MBPS', '35 MBPS', '50 MBPS', '100 MBPS'];
        $sbu = ['SBU', 'SBTG', 'SBS', 'JKB', 'JBB', 'JBTG', 'JBT', 'KAL', 'SIT', 'BNT'];

        for ($i = 0; $i < 500; $i++) {
            $randomDate = $startDate->copy()->addDays(rand(0, $daysDifference))->format('Y-m-d H:i:s');
            $layananData[] = [
                'idTagihan' => 00 + $i + 1,
                'pendapatan' => rand(100000, 1000000),
                'tanggalBayar' => $randomDate,
                'tanggalTagihan' => $randomDate,
                'bulan' => $months[rand(0, 11)],
                'tahun' => $years[rand(0, 4)],
                'namaLayanan' => 'ICONNET',
                'namaLayananProduk' => $product[rand(0,4)],
                'typeBilling' => rand(0, 1) ? 'prepaid' : 'postpaid',
                'namaKP' => 'KP ' . chr(rand(65, 90)),
                'namaSBU' => $sbu[rand(0, 9)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert data into database
        foreach ($layananData as $data) {
            DB::table('revenues')->insert($data);
        }
    }
}

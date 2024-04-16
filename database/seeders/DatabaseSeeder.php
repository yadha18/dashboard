<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('revenue_account_executives')->insert([
                'idPermohonan' => $faker->name,
                'salesInput' => $faker->name,
                'uplineSales' => $faker->name,
                'mitraSales' => $faker->name,
                'mitraUpline' => $faker->name,
                'tanggalAktivasi' => $faker->dateTimeThisMonth($max = 'now', $timezone = null)->format('Y-m-d H:i:s'),
                'namaLayanan' => $faker->word,
                'namaProduk' => $faker->word,
                'rpProduk' => $faker->numberBetween($min = 10000, $max = 100000),
            ]);
        }
    }
}

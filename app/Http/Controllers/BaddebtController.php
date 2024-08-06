<?php

namespace App\Http\Controllers;

use App\Models\Baddebt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BaddebtController extends Controller
{
    public function passivecustomer()
    {
        $data = Baddebt::paginate(750);
        $total = Baddebt::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.passive-customer', compact('data', 'user', 'total'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function getData()
    {
        $data = Baddebt::all();

        if (Auth::check()) {
            return view('auth.dashboard', compact('data'));
        }
        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function getCountBaddebts()
    {
        $sbu = [
            'BALI & NUSA TENGGARA',
            'JAKARTA & BANTEN',
            'JAWA BAGIAN BARAT',
            'JAWA BAGIAN TENGAH',
            'JAWA BAGIAN TIMUR',
            'KALIMANTAN',
            'SULAWESI & INDONESIA TIMUR',
            'SUMATERA BAGIAN SELATAN',
            'SUMATERA BAGIAN TENGAH',
            'SUMATERA BAGIAN UTARA'
        ];

        $result = [];

        foreach ($sbu as $region) {
            $count2020 = $this->filterBaddebt($region, 2020);
            $count2021 = $this->filterBaddebt($region, 2021);
            $count2022 = $this->filterBaddebt($region, 2022);
            $count2023 = $this->filterBaddebt($region, 2023);
            $result[] = [
                'namaSBU' => $region,
                'jumlah' => [
                    '2020' => $count2020,
                    '2021' => $count2021,
                    '2022' => $count2022,
                    '2023' => $count2023
                ]
            ];
        }

        return response()->json($result);
    }

    private function filterBaddebt($sbu, $year)
    {
        $data = Baddebt::whereYear('periodeIsolir', $year)
            ->where('namaSBU', $sbu)
            ->count();

        return $data;
    }

    public function getBaddebtData()
    {
        $data = Baddebt::select(
            'idPelanggan',
            'namaLayanan',
            'namaLayananProduk',
            'tanggalAktivasi',
            'tahunBulanAktivasi',
            'tanggalTagihan',
            'tahunBulanTagihan',
            'tanggalIsolir',
            'prepaid',
            'namaSBU',
            'namaKP',
            'salesInput',
            'totalTiket',
            'Promo'
        );

        return DataTables::of($data)->make(true);
    }
}

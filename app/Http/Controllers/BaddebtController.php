<?php

namespace App\Http\Controllers;

use App\Models\Baddebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaddebtController extends Controller
{
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
            $count = $this->filterBaddebt($region, 2021);
            $result[] = [
                'namaSBU' => $region,
                'jumlah' => $count
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
}

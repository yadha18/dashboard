<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PelangganDeaktivasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganDeaktivasiController extends Controller
{
    private function PDTable($sbu)
    {
        return PelangganDeaktivasi::where('namaSBU', $sbu)->get();
    }

    public function pelanggandeaktivasi()
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

        $total_pd = PelangganDeaktivasi::count();

        $user = User::select('name')->first();

        $table_bnt = $this->PDTable($sbu[0]);
        $table_jkb = $this->PDTable($sbu[1]);
        $table_jbb = $this->PDTable($sbu[2]);
        $table_jbtg = $this->PDTable($sbu[3]);
        $table_jbt = $this->PDTable($sbu[4]);
        $table_kal = $this->PDTable($sbu[5]);
        $table_sit = $this->PDTable($sbu[6]);
        $table_sbs = $this->PDTable($sbu[7]);
        $table_sbtg = $this->PDTable($sbu[8]);
        $table_sbu = $this->PDTable($sbu[9]);

        if (Auth::check()) {
            return view('auth.pelanggan-deaktivasi', compact(
                'user',
                'total_pd',
                'table_jkb',
                'table_bnt',
                'table_jbb',
                'table_jbtg',
                'table_jbt',
                'table_kal',
                'table_sit',
                'table_sbs',
                'table_sbtg',
                'table_sbu',
            ));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }
}

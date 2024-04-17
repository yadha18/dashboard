<?php

namespace App\Http\Controllers;

use App\Models\Baddebt;
use App\Models\User;
use App\Models\PelangganDeaktivasi;
use App\Models\Revenue;
use App\Models\RevenueAccountExecutive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard', 'passivecustomer', 'revenue', 'kanalbayar', 'pelanggandeaktivasi', 'cekNIKpage']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function cekNIKpage()
    {
        $user = User::select('name')->first();
        return view('auth.cek-nik', compact('user'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:250',
            'username' => 'required|string|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $validateData['name'],
            'username' => $validateData['username'],
            'password' => Hash::make($validateData['password']),
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    public function dashboard()
    {
        $total = Baddebt::count();
        $total_pd = PelangganDeaktivasi::count();
        $user = User::select('name')->first();
        $pendapatan_feb = $this->pendapatanByMonth(2024, 'Februari');
        $pendapatan_daily = Revenue::where('bulan', 'March')->where('tahun', '2024')->sum('pendapatan');
        $pendapatan_ae = RevenueAccountExecutive::sum('rpProduk');
        $totalPendapatan = Revenue::whereIn('tahun', ['2023', '2024'])->whereIn('bulan', ['August', 'September', 'October', 'November', 'December', 'January', 'February'])->sum('pendapatan');

        if (Auth::check()) {
            return view(
                'auth.dashboard',
                compact(
                    'total',
                    'total_pd',
                    'user',
                    'totalPendapatan',
                    'pendapatan_daily',
                    'pendapatan_feb',
                    'pendapatan_ae'
                )
            );
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    private function pendapatanByMonth($year, $month)
    {
        return Revenue::where('tahun', $year)->where('bulan', $month)->sum('pendapatan');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

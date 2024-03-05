<?php

namespace App\Http\Controllers;

use App\Models\Baddebt;
use App\Models\User;
use App\Models\KanalBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard', 'passivecustomer', 'revenue', 'kanalbayar', 'pelanggandeaktivasi']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
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

        return redirect()->route('dashboard');
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

        return back()->withErrors([
            'username' => 'username atau password salah'
        ])->withInput(['username']);
    }

    public function dashboard()
    {
        $total = Baddebt::count();
        $total_kanal = KanalBayar::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.dashboard', compact('total', 'user', 'total_kanal'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function passivecustomer()
    {
        $data = Baddebt::paginate(100);
        $total = Baddebt::count();
        $total_kanal = KanalBayar::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.passive-customer', compact('data', 'total', 'user', 'total_kanal'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function revenue()
    {
        $total = Baddebt::count();
        $total_kanal = KanalBayar::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.revenue', compact('total', 'user', 'total_kanal'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function kanalbayar()
    {
        $data = KanalBayar::paginate(100);
        $total = Baddebt::count();
        $total_kanal = KanalBayar::count();
        $user = User::select('name')->first();
        $bill_e_commerce = KanalBayar::where('pembayaranVia', 'ALTERRA')->sum('rpTagihanMinusPPN');
        $total_e_commerce = KanalBayar::where('pembayaranVia', 'ALTERRA')->count();

        if (Auth::check()) {
            return view('auth.kanal-bayar', compact('data', 'total', 'user', 'total_kanal', 'total_e_commerce', 'bill_e_commerce'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function pelanggandeaktivasi()
    {
        $total = Baddebt::count();
        $total_kanal = KanalBayar::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.pelanggan-deaktivasi', compact('total', 'user', 'total_kanal'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

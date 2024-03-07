<?php

namespace App\Http\Controllers;

use App\Models\Baddebt;
use App\Models\User;
use App\Models\KanalBayar;
use App\Models\PelangganDeaktivasi;
use App\Models\Revenue;
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
        $total_pd = PelangganDeaktivasi::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.dashboard', compact('total', 'total_pd', 'user', 'total_kanal'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function passivecustomer()
    {
        $data = Baddebt::paginate(100);
        $total = Baddebt::count();
        $user = User::select('name')->first();

        if (Auth::check()) {
            return view('auth.passive-customer', compact('data', 'user', 'total'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    public function revenue()
    {
        $total_kanal = KanalBayar::count();
        $total_pd = PelangganDeaktivasi::count();
        $user = User::select('name')->first();

        $postpaid_2023 = $this->getRevenue(2023, 'postpaid');
        $postpaid_2024 = $this->getRevenue(2024, 'postpaid');

        $prepaid_2023 = $this->getRevenue(2023, 'prepaid');;
        $prepaid_2024 = $this->getRevenue(2024, 'prepaid');;

        if (Auth::check()) {
            return view('auth.revenue', compact(
                'user',
                'total_kanal',
                'total_pd',
                'postpaid_2023',
                'postpaid_2024',
                'prepaid_2023',
                'prepaid_2024'
            ));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    private function getRevenue($year, $type)
    {
        return Revenue::where('tahun', $year)->where('typeBilling', $type)->get();
    }

    public function kanalbayar(Request $request)
    {
        $e_wallet = ['OVO', 'LINKAJA', 'LINKAJA-VA', 'GOPAY'];
        $modern_market = ['INDOMART', 'ALFA'];
        $bank = ['BRI-VA', 'BNI-VA', 'BCA-VA', 'MANDIRI', 'BANK LAINNYA'];
        $user = User::select('name')->first();

        $startDate = $request->input('start_date', '2019-01-01');
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $bill_bri = $this->sumBill($bank[0], $startDate, $endDate);
        $total_bri = $this->countBill($bank[0], $startDate, $endDate);

        $bill_bni = $this->sumBill($bank[1], $startDate, $endDate);
        $total_bni = $this->countBill($bank[1], $startDate, $endDate);

        $bill_bca = $this->sumBill($bank[2], $startDate, $endDate);
        $total_bca = $this->countBill($bank[2], $startDate, $endDate);

        $bill_mandiri = $this->sumBill($bank[3], $startDate, $endDate);
        $total_mandiri = $this->countBill($bank[3], $startDate, $endDate);

        $bill_otherbank = $this->sumBill($bank[4], $startDate, $endDate);
        $total_otherbank = $this->countBill($bank[4], $startDate, $endDate);

        $bill_indo = $this->sumBill($modern_market[0], $startDate, $endDate);
        $total_indo = $this->countBill($modern_market[0], $startDate, $endDate);

        $bill_alfa = $this->sumBill($modern_market[1], $startDate, $endDate);
        $total_alfa = $this->countBill($modern_market[1], $startDate, $endDate);

        $bill_ovo = $this->sumBill($e_wallet[0], $startDate, $endDate);
        $total_ovo = $this->countBill($e_wallet[0], $startDate, $endDate);

        $bill_linkaja = $this->sumBill($e_wallet[1], $startDate, $endDate);
        $total_linkaja = $this->countBill($e_wallet[1], $startDate, $endDate);

        $bill_gopay = $this->sumBill($e_wallet[2], $startDate, $endDate);
        $total_gopay = $this->countBill($e_wallet[2], $startDate, $endDate);

        $bill_e_commerce = $this->sumBill('ALTERRA', $startDate, $endDate);
        $total_e_commerce = $this->countBill('ALTERRA', $startDate, $endDate);

        if (Auth::check()) {
            return view('auth.kanal-bayar', compact('user', 'total_e_commerce', 'bill_e_commerce', 'bill_ovo', 'total_ovo', 'bill_linkaja', 'total_linkaja', 'bill_gopay', 'total_gopay', 'bill_indo', 'total_indo', 'bill_alfa', 'total_alfa', 'bill_bri', 'total_bri', 'bill_bni', 'total_bni', 'bill_bca', 'total_bca', 'bill_mandiri', 'total_mandiri', 'bill_otherbank', 'total_otherbank', 'startDate', 'endDate'));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }

    private function sumBill($paymentMethod, $startDate, $endDate)
    {
        return KanalBayar::where('pembayaranVia', $paymentMethod)->whereBetween('tanggalBayar', [$startDate, $endDate])->sum('rpTagihanMinusPPN');
    }

    private function countBill($paymentMethod, $startDate, $endDate)
    {
        return KanalBayar::where('pembayaranVia', $paymentMethod)->whereBetween('tanggalBayar', [$startDate, $endDate])->count();
    }

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

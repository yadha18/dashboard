<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RevenueAccountExecutive;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueAccountExecutiveController extends Controller
{
    public function revenueAccountExecutive()
    {
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        $user = User::select('name')->first();
        $data_ae = RevenueAccountExecutive::paginate(5000);
        $sum_ae = RevenueAccountExecutive::whereBetween('tanggalAktivasi', [$startDate, $endDate])->sum('rpProduk');

        return view('auth.revenue-ae', compact('user', 'data_ae', 'sum_ae'));
    }

    public function getAeRevenue()
    {
        $dailyRevenueQuery = $this->getAeRevenueQuery();

        return response()->json($dailyRevenueQuery);
    }

    public function getTop5DownlineSales()
    {
        $currentDate = Carbon::now();

        $topSales = RevenueAccountExecutive::select('salesInput as downlineSales')
            ->selectRaw('COUNT(salesInput) as jumlahSales')
            ->selectRaw('SUM(rpProduk) as pendapatan')
            ->whereBetween('tanggalAktivasi', ['2022-01-01', $currentDate])
            ->groupBy('salesInput')
            ->orderBy(DB::raw('COUNT(salesInput)'), 'desc')
            ->limit(5)
            ->get();

        return response()->json($topSales);
    }

    public function getTop5UplineSales()
    {
        $currentDate = Carbon::now();

        $upLineSales = RevenueAccountExecutive::select('uplineSales')
            ->selectRaw('COUNT(uplineSales) as jumlahSales')
            ->selectRaw('SUM(rpProduk) as pendapatan')
            ->whereBetween('tanggalAktivasi', ['2022-01-01', $currentDate])
            ->groupBy('uplineSales')
            ->orderBy(DB::raw('COUNT(uplineSales)'), 'desc')
            ->limit(5)
            ->get();

        return response()->json($upLineSales);
    }

    public function getAERevenueData(Request $request)
    {
        $bandwidth = $request->input('bandwidth');

        $revenueData = $this->getAERevenueBandwidth($bandwidth)->toArray();

        return response()->json($revenueData);
    }

    private function getAERevenueBandwidth($bandwidth)
    {
        return RevenueAccountExecutive::select('salesInput', 'namaProduk', DB::raw('COUNT(salesInput) as jumlahSales'), DB::raw('SUM(rpProduk) as pendapatan'))
            ->whereBetween('tanggalAktivasi', ['2022-01-01', Carbon::now()])
            ->where('namaProduk', $bandwidth)
            ->groupBy('salesInput', 'namaProduk')
            ->orderByRaw('COUNT(salesInput) DESC')
            ->take(500)
            ->get();
    }

    private function getAeRevenueQuery()
    {
        $startDate = Carbon::now()->subDays(7);
        $currentDate = Carbon::now();

        return RevenueAccountExecutive::selectRaw("FORMAT(tanggalAktivasi, 'yyyy-MM-dd') AS tanggalAktivasi")
            ->selectRaw("SUM(rpProduk) as pendapatan")
            ->whereBetween('tanggalAktivasi', [$startDate, $currentDate])
            ->groupBy(DB::raw("FORMAT(tanggalAktivasi, 'yyyy-MM-dd')"))
            ->get();
    }
}

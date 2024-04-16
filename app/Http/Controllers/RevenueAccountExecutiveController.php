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

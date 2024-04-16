<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function getRevenueData(Request $request)
    {
        $year = $request->input('year');
        $type = $request->input('type');

        $revenueData = $this->getRevenue($year, $type)->toArray();

        return response()->json($revenueData);
    }

    public function getPrepaidMonthRevenue()
    {
        $revenuesByMonth = $this->getMonthRevenue('prepaid');

        return response()->json($revenuesByMonth);
    }

    public function getPostpaidMonthRevenue()
    {
        $revenuesByMonth = $this->getMonthRevenue('postpaid');

        return response()->json($revenuesByMonth);
    }

    public function getDailyRevenue()
    {
        $dailyRevenueQuery = $this->getDailyRevenueQuery();

        return response()->json($dailyRevenueQuery);
    }

    public function getRegional()
    {
        $regional = Revenue::select('namaSBU')->distinct()->get();
        return response()->json($regional);
    }

    public function dailyRevenue()
    {
        $user = User::select('name')->first();
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        $daily = Revenue::select('idTagihan', 'pendapatan', 'typeBilling', 'tanggalBayar', 'bulan', 'tahun', 'namaLayanan', 'namaLayananProduk')
            ->where('bulan', 'April')->where('tahun', 2024)->take(500)->get();
        $sum_daily = Revenue::whereBetween('tanggalBayar', [$startDate, $endDate])->sum('pendapatan');

        return view('auth.revenue-daily', compact('user', 'daily', 'sum_daily'));
    }

    public function getProductPercentageRevenue()
    {
        $productSummaries = $this->calculateProductPercentageRevenue();

        return response()->json($productSummaries);
    }

    public function productRevenueChart()
    {
        $productRevenueData = Revenue::selectRaw('SUM(pendapatan) AS pendapatan, bulan, tahun, namaLayananProduk')
            ->whereIn('namaLayananProduk', ['5 MBPS', '10 MBPS', '20 MBPS', '35 MBPS', '50 MBPS', '100 MBPS'])
            ->groupBy('bulan', 'tahun', 'namaLayananProduk')
            ->orderBy('namaLayananProduk')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        return response()->json($productRevenueData);
    }

    public function productRevenue()
    {
        $user = User::select('name')->first();
        $mbps5 = $this->getProductRevenue('5 MBPS', 1000);
        $mbps10 = $this->getProductRevenue('10 MBPS', 750);
        $mbps20 = $this->getProductRevenue('20 MBPS', 500);
        $mbps35 = $this->getProductRevenue('35 MBPS', 500);
        $mbps50 = $this->getProductRevenue('50 MBPS', 500);
        $mbps100 = $this->getProductRevenue('100 MBPS', 500);
        $total_revenue = Revenue::sum('pendapatan');

        return view('auth.revenue-product', compact('user', 'mbps5', 'mbps10', 'mbps20', 'mbps35', 'mbps50', 'mbps100', 'total_revenue'));
    }

    public function revenue()
    {
        $user = User::select('name')->first();

        $years = ['2023', '2024'];
        $revenues = [];
        foreach ($years as $year) {
            $revenues[$year] = [
                'prepaid' => $this->getRevenue($year, 'prepaid')->sum('pendapatan'),
                'postpaid' => $this->getRevenue($year, 'postpaid')->sum('pendapatan'),
            ];
        }

        return view('auth.revenue', compact('user', 'revenues'));
    }

    private function getMonthRevenue($type)
    {
        $months = ['August', 'September', 'October', 'November', 'December', 'January', 'February', 'March'];

        return Revenue::selectRaw('bulan, sum(pendapatan) as total_pendapatan')
            ->whereIn('tahun', ['2023', '2024'])
            ->whereIn('bulan', $months)
            ->where('typeBilling', $type)
            ->groupBy('bulan')
            ->orderByRaw("FIELD(bulan, '" . implode("', '", $months) . "')")
            ->get();
    }

    private function getDailyRevenueQuery()
    {
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        return Revenue::selectRaw("FORMAT(tanggalBayar, 'yyyy-MM-dd') AS tanggalBayar")
            ->selectRaw("SUM(pendapatan) AS pendapatanHarian")
            ->whereBetween('tanggalBayar', [$startDate, $endDate])
            ->groupByRaw("FORMAT(tanggalBayar, 'yyyy-MM-dd')")
            ->get();
    }

    private function getRevenue($year, $type, $page = 1000)
    {
        return Revenue::where('tahun', $year)->where('typeBilling', $type)->paginate($page);
    }

    private function getProductRevenue($product, $count)
    {
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        return Revenue::select('idTagihan', 'pendapatan', 'typeBilling', 'tanggalBayar', 'bulan', 'tahun', 'namaLayanan', 'namaLayananProduk')
            ->where('namaLayananProduk', $product)
            ->whereBetween('tanggalBayar', [$startDate, $endDate])
            ->take($count)
            ->get();
    }

    private function calculateProductPercentageRevenue()
    {
        $products = ['5 MBPS', '10 MBPS', '20 MBPS', '35 MBPS', '50 MBPS', '100 MBPS'];
        $productSummaries = [];

        $totalRevenue = Revenue::where('tahun', 2024)->sum('pendapatan');

        foreach ($products as $product) {
            $productSummaries[$product] = Revenue::where('namaLayananProduk', $product)
                ->where('tahun', 2024)
                ->sum('pendapatan') / $totalRevenue * 100;
        }

        return $productSummaries;
    }

    private function sumRevenue($year, $type)
    {
        return Revenue::where('tahun', $year)->where('typeBilling', $type)->sum('pendapatan');
    }

    private function sumProduct($layanan)
    {
        return Revenue::where('namaLayananProduk', $layanan)->where('tahun', 2024)->sum('pendapatan');
    }
}

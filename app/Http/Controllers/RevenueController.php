<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HC;
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

    private function getProductRevenue($product, $count)
    {
        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subDays(7);
        $endDate = $currentDate;

        return Revenue::select('idTagihan', 'pendapatan', 'typeBilling', 'tanggalBayar', 'bulan', 'tahun', 'namaLayanan', 'namaLayananProduk')->where('namaLayananProduk', $product)->whereBetween('tanggalBayar', [$startDate, $endDate])->take($count)->get();
    }

    public function dailyRevenue()
    {
        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subDays(7);
        $endDate = $currentDate;

        $user = User::select('name')->first();
        $daily = Revenue::select('idTagihan', 'pendapatan', 'typeBilling', 'tanggalBayar', 'bulan', 'tahun', 'namaLayanan', 'namaLayananProduk')->where('bulan', 'April')->where('tahun', 2024)->take(500)->get();
        $sum_daily = Revenue::whereBetween('tanggalBayar', [$startDate, $endDate])->sum('pendapatan');

        return view('auth.revenue-daily', compact('user', 'daily', 'sum_daily'));
    }

    public function getProductPercentageRevenue()
    {
        $sum_5mbps = $this->sumProduct('5 MBPS');
        $sum_10mbps = $this->sumProduct('10 MBPS');
        $sum_20mbps = $this->sumProduct('20 MBPS');
        $sum_35mbps = $this->sumProduct('35 MBPS');
        $sum_50mbps = $this->sumProduct('50 MBPS');
        $sum_100mbps = $this->sumProduct('100 MBPS');

        $total_mbps = $sum_5mbps + $sum_10mbps + $sum_20mbps + $sum_35mbps + $sum_50mbps + $sum_100mbps;

        $percentage_5mbps = round(($sum_5mbps / $total_mbps) * 100, 1);
        $percentage_10mbps = round(($sum_10mbps / $total_mbps) * 100, 1);
        $percentage_20mbps = round(($sum_20mbps / $total_mbps) * 100, 1);
        $percentage_35mbps = round(($sum_35mbps / $total_mbps) * 100, 1);
        $percentage_50mbps = round(($sum_50mbps / $total_mbps) * 100, 1);
        $percentage_100mbps = round(($sum_100mbps / $total_mbps) * 100, 1);

        $data = [
            'data5mbps' => $percentage_5mbps,
            'data10mbps' => $percentage_10mbps,
            'data20mbps' => $percentage_20mbps,
            'data35mbps' => $percentage_35mbps,
            'data50mbps' => $percentage_50mbps,
            'data100mbps' => $percentage_100mbps,
        ];

        $total_percentage = array_sum($data);

        foreach ($data as $key => $percentage) {
            $data[$key] = $percentage / $total_percentage * 100;
        }

        $total_percentage = array_sum($data);
        if ($total_percentage != 100) {
            $min_key = array_keys($data, min($data))[0];
            $data[$min_key] += 100 - $total_percentage;
        }

        return response()->json($data);
    }

    public function productRevenueChart()
    {
        $data = Revenue::selectRaw('SUM(pendapatan) AS pendapatan, bulan, tahun, namaLayananProduk')->whereIn('namaLayananProduk', ['5 MBPS', '10 MBPS', '20 MBPS', '35 MBPS', '50 MBPS', '100 MBPS'])->groupBy('bulan', 'tahun', 'namaLayananProduk')->orderBy('namaLayananProduk')->orderBy('tahun')->orderBy('bulan')->get();

        return response()->json($data);
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

        $postpaid_2023 = $this->getRevenue(2023, 'postpaid');
        $postpaid_2024 = $this->getRevenue(2024, 'postpaid');
        $prepaid_2023 = $this->getRevenue(2023, 'prepaid');
        $prepaid_2024 = $this->getRevenue(2024, 'prepaid');

        $sum_prepaid_2023 = $this->sumRevenue(2023, 'prepaid');
        $sum_postpaid_2023 = $this->sumRevenue(2023, 'postpaid');
        $sum_prepaid_2024 = $this->sumRevenue(2024, 'prepaid');
        $sum_postpaid_2024 = $this->sumRevenue(2024, 'postpaid');

        if (Auth::check()) {
            return view('auth.revenue', compact(
                'user',
                'sum_prepaid_2023',
                'sum_postpaid_2023',
                'sum_prepaid_2024',
                'sum_postpaid_2024'
            ));
        }

        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
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

    private function sumRevenue($year, $type)
    {
        return Revenue::where('tahun', $year)->where('typeBilling', $type)->sum('pendapatan');
    }

    private function sumProduct($layanan)
    {
        return Revenue::where('namaLayananProduk', $layanan)->where('tahun', 2024)->sum('pendapatan');
    }

    public function getNasionalRevenue(Request $request)
    {
        $year = (int)$request->input('year');

        $revenueNasional = Revenue::select(DB::raw('SUM(pendapatan) as realisasi'), 'bulan', 'tahun')
            ->where('tahun', $year)
            ->groupBy('bulan', 'tahun')
            ->get();

        $result = $revenueNasional->map(function ($revenue) {
            $target = rand(1000000, 3000000);

            return [
                'realisasi' => $revenue->realisasi,
                'target' => $target,
                'bulan' => $revenue->bulan,
                'tahun' => $revenue->tahun
            ];
        });

        return response()->json($result);
    }

    public function getNasionalHC()
    {
        $today = Carbon::now()->format('Y-m-d');
        $results = HC::selectRaw('count(idPelanggan) as jumlahPelanggan, namaSBU')
            ->whereBetween('tanggalAktivasi', ['2024-01-01', $today])
            ->groupBy('namaSBU')
            ->get();

        return response()->json($results);
    }

    public function getSBURevenue()
    {
        $revenueSBU = Revenue::selectRaw('SUM(pendapatan) as realisasi, namaSBU')
            ->groupBy('namaSBU')
            ->get();

        $result_sbu = $revenueSBU->map(function ($revenue_sbu) {
            $target = rand(10000000, 15000000);

            return [
                'realisasi' => $revenue_sbu->realisasi,
                'target' => $target,
                'namaSBU' => $revenue_sbu->namaSBU
            ];
        });

        return response()->json($result_sbu);
    }
}

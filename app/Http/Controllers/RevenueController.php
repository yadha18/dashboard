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

    public function compareRevenueBillingTerbit(Request $request)
    {
        $tahunPertamaBillingTerbit = $request->input('tahunPertamaBillingTerbit');
        $tahunKeduaBillingTerbit = $request->input('tahunKeduaBillingTerbit');

        if (!$tahunPertamaBillingTerbit || !$tahunKeduaBillingTerbit) {
            return response()->json([
                'error' => 'Tahun pertama dan tahun kedua harus diisi!'
            ], 400);
        }

        $dataPertamaRevenueBT = Revenue::selectRaw('SUM(pendapatan) as pendapatan, bulan')
            ->where('tahun', $tahunPertamaBillingTerbit)
            ->whereNotNull('tanggalTagihan')
            ->groupBy('bulan')
            ->get();

        $dataKeduaRevenueBT = Revenue::selectRaw('SUM(pendapatan) as pendapatan, bulan')
            ->where('tahun', $tahunKeduaBillingTerbit)
            ->whereNotNull('tanggalTagihan')
            ->groupBy('bulan')
            ->get();

        $labels = $this->generateMonthLabels();
        $data1_BT = $this->formatData($dataPertamaRevenueBT);
        $data2_BT = $this->formatData($dataKeduaRevenueBT);

        return response()->json([
            'labels' => $labels,
            'data_pertama' => $data1_BT,
            'data_kedua' => $data2_BT
        ]);
    }

    public function compareRevenueMonthBillingTerbit(Request $request)
    {
        $startDatePertama_BT = $request->input('startDatePertama_BT');
        $endDatePertama_BT = $request->input('endDatePertama_BT');
        $startDateKedua_BT = $request->input('startDateKedua_BT');
        $endDateKedua_BT = $request->input('endDateKedua_BT');

        if (!$startDatePertama_BT || !$endDatePertama_BT || !$startDateKedua_BT || !$endDateKedua_BT) {
            return response()->json(['error' => 'Lengkapi tanggal periode'], 400);
        }

        $dataPertama_BT = Revenue::selectRaw('sum(pendapatan) as pendapatan, namaSBU')
            ->whereBetween('tanggalTagihan', [$startDatePertama_BT, $endDatePertama_BT])
            ->groupBy('namaSBU')
            ->get();

        $dataKedua_BT = Revenue::selectRaw('sum(pendapatan) as pendapatan, namaSBU')
            ->whereBetween('tanggalTagihan', [$startDateKedua_BT, $endDateKedua_BT])
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_BT_1 = $this->formatDataRevenueByMonth($dataPertama_BT);
        $data_BT_2 = $this->formatDataRevenueByMonth($dataKedua_BT);

        return response()->json([
            'labels' => $labels,
            'data_BT_1' => $data_BT_1,
            'data_BT_2' => $data_BT_2
        ]);
    }

    public function compareRevenueDayBillingTerbit(Request $request)
    {
        $startDateDay_BT = $request->input('startDateDay_BT');
        $endDateDay_BT = $request->input('endDateDay_BT');

        if (!$startDateDay_BT || !$endDateDay_BT) {
            return response()->json(['error' => 'Lengkapi tanggal periode'], 400);
        }

        if ($startDateDay_BT < $endDateDay_BT) {
            return response()->json(['error' => 'Periode awal tidak boleh lebih kecil dibanding periode akhir']);
        }

        $dataDateDay_1 = Revenue::selectRaw('sum(pendapatan) as pendapatan, namaSBU')
            ->whereDate('tanggalTagihan', $startDateDay_BT)
            ->groupBy('namaSBU')
            ->get();

        $dataDateDay_2 = Revenue::selectRaw('sum(pendapatan) as pendapatan, namaSBU')
            ->whereDate('tanggalTagihan', $endDateDay_BT)
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_1 = $this->formatDataRevenueByMonth($dataDateDay_1);
        $data_2 = $this->formatDataRevenueByMonth($dataDateDay_2);

        return response()->json([
            'labels' => $labels,
            'data_1' => $data_1,
            'data_2' => $data_2
        ]);
    }

    public function compareRevenueData(Request $request)
    {
        $tahunPertama = $request->input('tahunPertama');
        $tahunKedua = $request->input('tahunKedua');

        if (!$tahunPertama || !$tahunKedua) {
            return response()->json([
                'error' => 'Tahun pertama dan tahun kedua harus diisi!'
            ], 400);
        }

        $dataPertama = Revenue::selectRaw('SUM(pendapatan) as pendapatan, bulan')
            ->where('tahun', $tahunPertama)
            ->whereNotNull('tanggalBayar')
            ->groupBy('bulan')
            ->get();

        $dataKedua = Revenue::selectRaw('SUM(pendapatan) as pendapatan, bulan')
            ->where('tahun', $tahunKedua)
            ->whereNotNull('tanggalBayar')
            ->groupBy('bulan')
            ->get();

        $labels = $this->generateMonthLabels();
        $data1 = $this->formatData($dataPertama);
        $data2 = $this->formatData($dataKedua);

        return response()->json([
            'labels' => $labels,
            'data1' => $data1,
            'data2' => $data2,
        ]);
    }

    public function compareRevenueMonthData(Request $request)
    {
        $tanggalRevenueAwal_1 = $request->input('startDatePertama');
        $tanggalRevenueAwal_2 = $request->input('startDateKedua');
        $tanggalRevenueAkhir_1 = $request->input('endDatePertama');
        $tanggalRevenueAkhir_2 = $request->input('endDateKedua');

        if (!$tanggalRevenueAwal_1 || !$tanggalRevenueAkhir_1 || !$tanggalRevenueAwal_2 || !$tanggalRevenueAkhir_2) {
            return response()->json(['error' => 'Periode wajib diisi!'], 400);
        }

        if ($tanggalRevenueAwal_1 > $tanggalRevenueAkhir_1 && $tanggalRevenueAwal_2 > $tanggalRevenueAkhir_2) {
            return response()->json(['error' => 'periode akhir tidak boleh lebih besar dibanding periode awal'], 400);
        }

        $dataRevenuePertama = Revenue::selectRaw('sum(pendapatan) as pendapatan, namaSBU')
            ->whereBetween('tanggalBayar', [$tanggalRevenueAwal_1, $tanggalRevenueAkhir_1])
            ->groupBy('namaSBU')
            ->get();

        $dataRevenueKedua = Revenue::selectRaw('sum(pendapatan) as pendapatan, namaSBU')
            ->whereBetween('tanggalBayar', [$tanggalRevenueAwal_2, $tanggalRevenueAkhir_2])
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_month_rev_1 = $this->formatDataRevenueByMonth($dataRevenuePertama);
        $data_month_rev_2 = $this->formatDataRevenueByMonth($dataRevenueKedua);

        return response()->json([
            'labels' => $labels,
            'data_month_rev_1' => $data_month_rev_1,
            'data_month_rev_2' => $data_month_rev_2
        ]);
    }

    public function compareRevenueDayData(Request $request)
    {
        $startDateDay = $request->input('startDateDay');
        $endDateDay = $request->input('endDateDay');

        if (!$startDateDay || !$endDateDay) {
            return response()->json(['error' => 'Periode wajib diisi!'], 400);
        }

        if ($startDateDay < $endDateDay) {
            return response()->json(['error' => 'periode akhir tidak boleh lebih besar dibanding periode awal'], 400);
        }

        $dataRevenueHarian_1 = Revenue::selectRaw('SUM(pendapatan) as pendapatan, namaSBU')
            ->whereDate('tanggalBayar', $startDateDay)
            ->groupBy('namaSBU')
            ->get();

        $dataRevenueHarian_2 = Revenue::selectRaw('SUM(pendapatan) as pendapatan, namaSBU')
            ->whereDate('tanggalBayar', $endDateDay)
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_day_rev_1 = $this->formatDataRevenueByMonth($dataRevenueHarian_1);
        $data_day_rev_2 = $this->formatDataRevenueByMonth($dataRevenueHarian_2);

        return response()->json([
            'labels' => $labels,
            'data_day_rev_1' => $data_day_rev_1,
            'data_day_rev_2' => $data_day_rev_2
        ]);
    }

    public function compareHCData(Request $request)
    {
        $hcPertama = $request->input('hcPertama');
        $hcKedua = $request->input('hcKedua');

        if (!$hcPertama || !$hcKedua) {
            return response()->json(['error' => 'Tahun pertama dan tahun kedua wajib diisi!'], 400);
        }

        $dataHCPertama = HC::selectRaw('count(idPelanggan) as jumlahHC, namaSBU')
            ->whereYear('tanggalAktivasi', $hcPertama)
            ->groupBy('namaSBU')
            ->get();

        $dataHCKedua = HC::selectRaw('count(idPelanggan) as jumlahHC, namaSBU')
            ->whereYear('tanggalAktivasi', $hcKedua)
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_HC_1 = $this->formatDataHC($dataHCPertama);
        $data_HC_2 = $this->formatDataHC($dataHCKedua);

        return response()->json([
            'labels' => $labels,
            'data_HC_1' => $data_HC_1,
            'data_HC_2' => $data_HC_2
        ]);
    }

    public function compareHCMonthData(Request $request)
    {
        $tanggalHCAwal_1 = $request->input('hcStartDatePertama');
        $tanggalHCAwal_2 = $request->input('hcStartDateKedua');
        $tanggalHCAkhir_1 = $request->input('hcEndDatePertama');
        $tanggalHCAkhir_2 = $request->input('hcEndDateKedua');

        $bulanHCPertama = HC::selectRaw('count(idPelanggan) as jumlahHC, namaSBU')
            ->whereBetween('tanggalAktivasi', [$tanggalHCAwal_1, $tanggalHCAkhir_1])
            ->groupBy('namaSBU')
            ->get();

        $bulanHCKedua = HC::selectRaw('count(idPelanggan) as jumlahHC, namaSBU')
            ->whereBetween('tanggalAktivasi', [$tanggalHCAwal_2, $tanggalHCAkhir_2])
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_month_hc_1 = $this->formatDataHC($bulanHCPertama);
        $data_month_hc_2 = $this->formatDataHC($bulanHCKedua);

        return response()->json([
            'labels' => $labels,
            'bulan_pertama' => $data_month_hc_1,
            'bulan_kedua' => $data_month_hc_2
        ]);
    }

    public function compareHCDayData(Request $request)
    {
        $tanggalHCAwal = $request->input('hcStartDateDay');
        $tanggalHCAkhir = $request->input('hcEndDateDay');

        $dataHariHC_1 = HC::selectRaw('count(idPelanggan) as jumlahHC, namaSBU')
            ->whereDate('tanggalAktivasi', $tanggalHCAwal)
            ->groupBy('namaSBU')
            ->get();

        $dataHariHC_2 = HC::selectRaw('count(idPelanggan) as jumlahHC, namaSBU')
            ->whereDate('tanggalAktivasi', $tanggalHCAkhir)
            ->groupBy('namaSBU')
            ->get();

        $labels = $this->generateSBULabels();
        $data_hc_day_1 = $this->formatDataHC($dataHariHC_1);
        $data_hc_day_2 = $this->formatDataHC($dataHariHC_2);

        return response()->json([
            'labels' => $labels,
            'data_hc_1' => $data_hc_day_1,
            'data_hc_2' => $data_hc_day_2
        ]);
    }

    private function generateMonthLabels()
    {
        return ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    }

    private function generateSBULabels()
    {
        return ["SBU", "SBTG", "SBS", "JKB", "JBB", "JBTG", "JBT", "KAL", "SIT", "BNT"];
    }

    private function formatData($data)
    {
        $monthlyData = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $monthIndex = array_search($item->bulan, $this->generateMonthLabels());
            if ($monthIndex !== false) {
                $monthlyData[$monthIndex] = $item->pendapatan;
            }
        }

        return $monthlyData;
    }

    private function formatDataRevenueByMonth($data)
    {
        $monthlyData = array_fill(0, 10, 0);

        foreach ($data as $item) {
            $monthIndex = array_search($item->namaSBU, $this->generateSBULabels());
            if ($monthIndex !== false) {
                $monthlyData[$monthIndex] = $item->pendapatan;
            }
        }

        return $monthlyData;
    }

    private function formatDataHC($data)
    {
        $sbuData = array_fill(0, 10, 0);

        foreach ($data as $item) {
            $sbuIndex = array_search($item->namaSBU, $this->generateSBULabels());
            if ($sbuIndex !== false) {
                $sbuData[$sbuIndex] = $item->jumlahHC;
            }
        }

        return $sbuData;
    }
}

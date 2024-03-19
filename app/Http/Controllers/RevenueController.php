<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KanalBayar;
use App\Models\PelangganDeaktivasi;
use App\Models\Revenue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    public function getRevenueData(Request $request)
    {
        $year = $request->input('year');
        $type = $request->input('type');
        $regional = $request->input('regional');

        $revenueData = $this->getRevenueByRegion($year, $type, $regional);

        return response()->json($revenueData);
    }

    public function getPrepaidMonthRevenue()
    {
        $revenuesByMonth = Revenue::selectRaw('bulan, sum(pendapatan) as total_pendapatan')
            ->whereIn('tahun', ['2023', '2024'])
            ->whereIn('bulan', ['Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret'])
            ->where('typeBilling', 'prepaid')
            ->groupBy('bulan')
            ->orderByRaw("
        CASE bulan
            WHEN 'Agustus' THEN 1
            WHEN 'September' THEN 2
            WHEN 'Oktober' THEN 3
            WHEN 'November' THEN 4
            WHEN 'Desember' THEN 5
            WHEN 'Januari' THEN 6
            WHEN 'Februari' THEN 7
            WHEN 'Maret' THEN 8
            ELSE 9
        END
        ")->get();

        return response()->json($revenuesByMonth);
    }

    public function getPostpaidMonthRevenue()
    {
        $revenuesByMonth = Revenue::selectRaw('bulan, sum(pendapatan) as total_pendapatan')
            ->whereIn('tahun', ['2023', '2024'])
            ->whereIn('bulan', ['Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret'])
            ->where('typeBilling', 'postpaid')
            ->groupBy('bulan')
            ->orderByRaw("
        CASE bulan
            WHEN 'Agustus' THEN 1
            WHEN 'September' THEN 2
            WHEN 'Oktober' THEN 3
            WHEN 'November' THEN 4
            WHEN 'Desember' THEN 5
            WHEN 'Januari' THEN 6
            WHEN 'Februari' THEN 7
            WHEN 'Maret' THEN 8
            ELSE 9
        END
        ")->get();

        return response()->json($revenuesByMonth);
    }

    public function getRegional()
    {
        $regional = Revenue::select('namaSBU')->distinct()->get();
        return response()->json($regional);
    }

    private function getRevenueByRegion($year, $type, $regional)
    {
        $query = Revenue::where('tahun', $year)->where('typeBilling', $type);

        if (!empty($regional)) {
            $query->where('namaSBU', $regional);
        }

        return $query->get();
    }

    public function dailyRevenue()
    {
        $user = User::select('name')->first();

        return view('auth.revenue-daily', compact('user'));
    }

    public function revenue()
    {
        $total_kanal = KanalBayar::count();
        $total_pd = PelangganDeaktivasi::count();
        $user = User::select('name')->first();

        $postpaid_2023 = $this->getRevenue(2023, 'postpaid');
        $postpaid_2024 = $this->getRevenue(2024, 'postpaid');

        $prepaid_2023 = $this->getRevenue(2023, 'prepaid');
        $prepaid_2024 = $this->getRevenue(2024, 'prepaid');

        $sum_postpaid_2023 = $this->sumRevenue(2023, 'postpaid');
        $sum_postpaid_2024 = $this->sumRevenue(2024, 'postpaid');

        if (Auth::check()) {
            return view('auth.revenue', compact(
                'user',
                'total_kanal',
                'total_pd',
                'postpaid_2023',
                'postpaid_2024',
                'prepaid_2023',
                'prepaid_2024',
                'sum_postpaid_2023',
                'sum_postpaid_2024'
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
    private function sumRevenue($year, $type)
    {
        return Revenue::where('tahun', $year)->where('typeBilling', $type)->sum('pendapatan');
    }
}

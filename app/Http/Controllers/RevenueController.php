<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function getRevenueData(Request $request)
    {
        $year = $request->input('year');
        $type = $request->input('type');
        $regional = $request->input('regional');

        $revenueData = $this->getRevenue($year, $type, $regional);

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

    private function getRevenue($year, $type, $regional)
    {
        $query = Revenue::where('tahun', $year)->where('typeBilling', $type);

        if (!empty($regional)) {
            $query->where('namaSBU', $regional);
        }

        return $query->get();
    }
}

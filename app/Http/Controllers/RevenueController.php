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

    public function getMonthRevenue()
    {
        $revenues = Revenue::whereYear('tahun', '>=', 2023)->whereYear('tahun', '<=', 2024)->whereIn('bulan', ['Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret'])->get();

        // $revenuesByMonth = [];

        // foreach ($revenues as $revenue) {
        //     $bulan = $revenue->bulan;
        //     $pendapatan = $revenue->pendapatan;
        // }

        // if (array_key_exists($bulan, $revenuesByMonth)) {
        //     $revenuesByMonth[$bulan] += $pendapatan;
        // } else {
        //     $revenuesByMonth[$bulan] = $pendapatan;
        // }

        return response()->json($revenues);
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

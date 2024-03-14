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
        $revenuesByMonth = Revenue::selectRaw('bulan, sum(pendapatan) as pendapatan')->whereYear('tahun', '>=', 2023)->whereYear('tahun', '<=', 2024)->groupBy('bulan')->get();

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

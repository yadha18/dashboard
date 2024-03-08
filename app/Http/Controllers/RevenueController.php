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
        $region = $request->input('region');

        $revenueData = $this->getFilteredRevenue($year, $region);

        return response()->json($revenueData);
    }

    private function getFilteredRevenue($year, $region)
    {
        $query = Revenue::query();

        if ($year !== 'all') {
            $query->where('tahun', $year);
        }

        if ($region !== 'all') {
            $query->where('namaSBU', $region);
        }

        return $query->get();
    }


    private function getRevenue($year, $region)
    {
        return Revenue::where('tahun', $year)->where('namaSBU', $region)->get();
    }
}

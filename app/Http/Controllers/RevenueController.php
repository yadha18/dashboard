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

        $revenueData = $this->getRevenue($year, $region);

        return response()->json($revenueData);
    }
    private function getRevenue($year, $region)
    {
        return Revenue::where('tahun', $year)->where('namaSBU', $region)->get();
    }
}

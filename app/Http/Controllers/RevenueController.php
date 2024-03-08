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

        $revenueData = $this->getRevenue($year, $type);

        return response()->json($revenueData);
    }
    private function getRevenue($year, $type)
    {
        return Revenue::where('tahun', $year)->where('typeBilling', $type)->get();
    }
}

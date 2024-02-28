<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData()
    {
        $data = Chart::all();
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RevenueAccountExecutive;
use App\Models\User;
use Illuminate\Http\Request;

class RevenueAccountExecutiveController extends Controller
{
    public function revenueAccountExecutive()
    {
        $user = User::select('name')->first();
        $data_ae = RevenueAccountExecutive::paginate(500);

        return view('auth.revenue-ae', compact('user', 'data_ae'));
    }
}

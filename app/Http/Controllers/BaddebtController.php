<?php

namespace App\Http\Controllers;

use App\Models\Baddebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaddebtController extends Controller
{
    public function getData()
    {
        $data = Baddebt::all();

        if (Auth::check()) {
            return view('auth.dashboard', compact('data'));
        }
        return redirect()->route('login')->withErrors([
            'username' => 'silakan login terlebih dahulu'
        ])->withInput(['username']);
    }
}

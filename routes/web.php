<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.dashboard');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/dashboard/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/passive-customer', 'passivecustomer')->name('passive-customer');
    Route::get('/dashboard/kanal-bayar', 'kanalbayar')->name('kanal-bayar');
    Route::get('/dashboard/pelanggan-deaktivasi', 'pelanggandeaktivasi')->name('pelanggan-deaktivasi');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/dashboard/revenue', 'App\Http\Controllers\UserController@revenue')->name('revenue');
Route::get('/chart-data', 'App\Http\Controllers\ChartController@getChartData');

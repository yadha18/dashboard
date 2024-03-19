<?php

use App\Http\Controllers\BaddebtController;
use App\Http\Controllers\KanalBayarController;
use App\Http\Controllers\PelangganDeaktivasiController;
use App\Http\Controllers\RevenueController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/dashboard/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(BaddebtController::class)->group(function () {
    Route::get('/dashboard/passive-customer', 'passivecustomer')->name('passive-customer');
    Route::get('/get-baddebt-2021', 'getCountBaddebts');
    Route::get('/baddebt/data', 'getBaddebtData')->name('baddebt.data');
});

Route::controller(RevenueController::class)->group(function () {
    Route::get('/dashboard/revenue', 'revenue')->name('revenue');
    Route::get('/dashboard/revenue/daily', 'dailyRevenue')->name('dailyRevenue');
    Route::get('/get-revenue-data', 'getRevenueData');
    Route::get('/get-regional', 'getRegional');
    Route::get('/get-prepaid-revenue', 'getPrepaidMonthRevenue');
    Route::get('/get-postpaid-revenue', 'getPostpaidMonthRevenue');
});

Route::controller(KanalBayarController::class)->group(function () {
    Route::get('/dashboard/kanal-bayar', 'kanalbayar')->name('kanal-bayar');
    Route::get('/get-total-kanal', 'pembayaranViaCount');
});

Route::controller(PelangganDeaktivasiController::class)->group(function () {
    Route::get('/dashboard/pelanggan-deaktivasi', 'pelanggandeaktivasi')->name('pelanggan-deaktivasi');
});

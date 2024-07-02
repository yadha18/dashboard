<?php

use App\Http\Controllers\BaddebtController;
use App\Http\Controllers\KanalBayarController;
use App\Http\Controllers\PelangganDeaktivasiController;
use App\Http\Controllers\RevenueAccountExecutiveController;
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
    Route::get('/dashboard/ceknik', 'cekNIKpage')->name('cekNIKpage');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(BaddebtController::class)->group(function () {
    Route::get('/dashboard/passive-customer', 'passivecustomer')->name('passive-customer');
    Route::get('/baddebt/data', 'getBaddebtData')->name('baddebt.data');
});

Route::controller(RevenueController::class)->group(function () {
    Route::get('/dashboard/revenue', 'revenue')->name('revenue');
    Route::get('/dashboard/revenue/table', 'revenueTablePage')->name('revenue.table');
    Route::get('/dashboard/revenue/table/list', 'getRevenueTable')->name('revenue.list');
    Route::get('/dashboard/revenue/daily', 'dailyRevenue')->name('dailyRevenue');
    Route::get('/dashboard/revenue/product', 'productRevenue')->name('productRevenue');
});

Route::controller(KanalBayarController::class)->group(function () {
    Route::get('/dashboard/kanal-bayar', 'kanalbayar')->name('kanal-bayar');
});

Route::controller(PelangganDeaktivasiController::class)->group(function () {
    Route::get('/dashboard/pelanggan-deaktivasi', 'pelanggandeaktivasi')->name('pelanggan-deaktivasi');
});

Route::controller(RevenueAccountExecutiveController::class)->group(function () {
    Route::get('/dashboard/revenue/account-executive', 'revenueAccountExecutive')->name('revenueAccountExecutive');
});

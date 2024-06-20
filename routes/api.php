<?php

use App\Http\Controllers\RevenueAccountExecutiveController;
use App\Http\Controllers\RevenueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RevenueController::class)->group(function () {
    // Route::get('/get-revenue-data', 'getRevenueData');
    Route::get('/get-regional', 'getRegional');
    Route::get('/get-prepaid-revenue', 'getPrepaidMonthRevenue');
    Route::get('/get-postpaid-revenue', 'getPostpaidMonthRevenue');
    Route::get('/get-product-revenue', 'getProductPercentageRevenue');
    Route::get('/get-product-chart', 'productRevenueChart');
    Route::get('/get-daily-revenue', 'getDailyRevenue');
    Route::get('/get-revenue-nasional', 'getNasionalRevenue');
    Route::get('/get-nasional-hc', 'getNasionalHC');
    Route::get('/get-revenue-sbu', 'getSBURevenue');
    Route::get('/get-compare-revenue', 'compareRevenueData');
    Route::get('/get-compare-month-revenue', 'compareRevenueMonthData');
    Route::get('/get-compare-hc', 'compareHCData');
    Route::get('/get-compare-month-hc', 'compareHCMonthData');
    Route::get('/get-compare-day-hc', 'compareHCDayData');
});

Route::controller(RevenueAccountExecutiveController::class)->group(function () {
    Route::get('/get-ae-revenue', 'getAeRevenue');
    Route::get('/get-top-5-downline', 'getTop5DownlineSales');
    Route::get('/get-top-5-upline', 'getTop5UplineSales');
    Route::get('/get-ae-revenue-data-downline', 'getAERevenueDataDownline');
    Route::get('/get-ae-revenue-data-upline', 'getAERevenueDataUpline');
});

Route::get('/get-baddebt-2021', 'App/Http/Controllers/RevenueController@getCountBaddebts');
Route::get('/get-total-kanal', 'App/Http/Controllers/RevenueController@pembayaranViaCount');

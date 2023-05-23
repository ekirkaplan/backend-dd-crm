<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $arrivalTonnage = 220;
    $date = now();
    $squad = \App\Models\Squad::find(1);
    $unitPrice = $squad->unitPrices()
        ->where('start_date', '<=', $date)
        ->orWhere('end_date', '>=', $date)
        ->first();
    if (is_null($unitPrice)) {
        return 0;
    } else {
        return $unitPrice->price * (int)$arrivalTonnage;
    }
});

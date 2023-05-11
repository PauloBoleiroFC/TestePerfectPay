<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['prefix' => 'payment'], function () {
        Route::get('/get-bar-code/{id}', [PaymentController::class, 'getBarCode'])->name('payment.get-bar-code');
        Route::get('/pix/{id}', [PaymentController::class, 'pix'])->name('payment.pix');
        Route::get('/credit-card/{id}', [PaymentController::class, 'creditCard'])->name('payment.credit-card');
        Route::post('/credit-card/pay', [PaymentController::class, 'pay'])->name('payment.credit-card.pay');
    });

    Route::group(['prefix' => 'charge'], function () {
        Route::get('/new', [ChargeController::class, 'newCharge'])->name('customer.new');
    });
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Seller\DashboardController;
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

Route::get('seller-login', [AuthController::class, 'index'])->name('seller.login.get')->middleware('guest');;
Route::post('seller-login', [AuthController::class, 'login'])->name('seller.login.post');

Route::get('seller/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard')->middleware('seller');

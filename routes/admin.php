<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('admin-login', [AuthController::class, 'index'])->name('admin.login.get')->middleware('guest');
Route::post('admin-login', [AuthController::class, 'login'])->name('admin.login.post');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')
    ->middleware('admin');

Route::get('admin/categories/add', [CategoryController::class, 'create'])->name('admin.categories.get')
    ->middleware('admin');
Route::post('admin/categories/add', [CategoryController::class, 'store'])->name('admin.categories.post')
    ->middleware('admin');

Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories')
    ->middleware('admin');

Route::get('admin/sub-categories', [CategoryController::class, 'subCategories'])->name('admin.sub_categories')
    ->middleware('admin');

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

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('categories/add', [CategoryController::class, 'create'])->name('admin.categories.get');
    Route::post('categories/add', [CategoryController::class, 'store'])->name('admin.categories.post');

    // Route::delete('categories', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::get('categories/delete/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update', [CategoryController::class, 'update'])->name('admin.categories.update');


    Route::get('sub-categories', [CategoryController::class, 'subCategories'])->name('admin.sub_categories');
});

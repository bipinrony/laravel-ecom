<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
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
   // Category
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('categories/add', [CategoryController::class, 'create'])->name('admin.categories.get');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('admin.categories.post');

    Route::get('categories/delete/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    
    // Subcategory
    Route::get('sub-categories', [SubCategoryController::class, 'index'])->name('admin.sub_categories');
    Route::get('subcategories/add', [SubCategoryController::class, 'create'])->name('admin.subcategories.get');
    Route::post('subcategories/store', [SubCategoryController::class, 'store'])
        ->name('admin.subcategories.post');

    Route::get('subcategories/edit/{subCategory}', [SubCategoryController::class, 'edit'])
        ->name('admin.subcategories.edit');
    Route::post('subcategories/update', [SubCategoryController::class, 'update'])->name('admin.subcategories.update');
    Route::get('subcategories/delete/{subcategory}', [SubCategoryController::class, 'delete'])->name('admin.subcategories.delete');

    // Product
    Route::get('product', [ProductController::class, 'index'])->name('admin.products');
    Route::get('product/add', [ProductController::class, 'create'])->name('admin.product.get');
    Route::post('product/store', [ProductController::class, 'store'])->name('admin.product.post');

    Route::get('product/delete/{product}', [ProductController::class, 'delete'])->name('admin.product.delete');
    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('product/update', [ProductController::class,'update'])->name('admin.product.update');

    //slider
    Route::get('slider', [SliderController::class, 'index'])->name('admin.sliders');
    Route::get('slider/add', [SliderController::class, 'create'])->name('admin.slider.get');
    Route::post('slider/store', [SliderController::class, 'store'])->name('admin.slider.post');
    Route::get('slider/edit/{slider}', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::post('slider/update', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::get('slider/delete/{slider}', [SliderController::class, 'delete'])->name('admin.slider.delete');

    
});

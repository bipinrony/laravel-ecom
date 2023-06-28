<?php

use App\Http\Controllers\DBController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FacebookAuthController;
use App\Http\Controllers\Frontend\GoogleAuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\HttpClientController;
use App\Http\Controllers\LocalizationController;
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


Route::get('/switch-language/{lang}', [LocalizationController::class, 'SwitchLanguage'])->name('switch-language');

Route::get('/db', [DBController::class, 'index']);
Route::get('/http', [HttpClientController::class, 'index']);
Route::get('/factory', [FactoryController::class, 'index']);


Route::middleware(['locale'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login.get');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registerView'])->name('register.get');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/shop/{category_slug?}/{sub_category_slug?}', [HomeController::class, 'shop'])->name('shop');
    Route::get('/product/{product_slug}', [HomeController::class, 'product'])->name('product');

    Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google_login');
    Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

    Route::get('auth/facebook', [FacebookAuthController::class, 'redirectToFacebook'])->name('facebook_login');
    Route::get('auth/facebook/callback', [FacebookAuthController::class, 'handleFacebookCallback']);

    Route::middleware(['auth'])->group(function () {
        Route::get('/cart/get-count', [CartController::class, 'getCount'])->name('cartCount');
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::get('/cart/add/{product}/{quantity}', [CartController::class, 'addToCart'])->name('add-to-cart');
        Route::get('/cart/delete/{cartItem}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::post('/cart/update-quantity/{cartItem}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
});

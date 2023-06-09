<?php

use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/sub-categories', [CategoryController::class, 'subCategories']);

Route::post('/add-test-data', function (Request $request) {
    \DB::table('testing')->insert(
        ['name' => $request->name]
    );
    return response()->json(['success' => true]);
});

Route::post('/test-data', function (Request $request) {
    $test = \DB::table('testing')->get();
    return response()->json(['success' => true, 'data' => $test]);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\AuthController;

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

// public route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/food/{id}', [FoodController::class, 'show']);
Route::get('/belis', [BeliController::class, 'index']);
Route::get('beli/{id}', [BeliController::class, 'show']);

// protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('food', FoodController::class)->except('create', 'edit', 'show', 'index');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('belis', BeliController::class)->except('create', 'edit', 'show', 'index');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::prefix('admin')->group(function () {
             Route::resource('food', FoodController::class);
        });
});
});


<?php

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

Route::post('/sanctum/token', [App\Http\Controllers\Api\Auth\AuthClientController::class, 'auth']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/auth/me', [App\Http\Controllers\Api\Auth\AuthClientController::class, 'me']);
    Route::post('/auth/logout', [App\Http\Controllers\Api\Auth\AuthClientController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->namespace('Api')->group(function () {

    Route::get('/tenants/{uuid}', [App\Http\Controllers\Api\TenantApiController::class, 'show']);
    Route::get('/tenants', [App\Http\Controllers\Api\TenantApiController::class, 'index']);

    Route::get('/categories/{id}', [App\Http\Controllers\Api\CategoryApiController::class, 'show']);
    Route::get('/categories', [App\Http\Controllers\Api\CategoryApiController::class, 'categoriesByTentant']);

    Route::get('/tables/{identify}', [App\Http\Controllers\Api\TableApiController::class, 'show']);
    Route::get('/tables', [App\Http\Controllers\Api\TableApiController::class, 'tablesByTenant']);

    Route::get('/products/{identify}', [App\Http\Controllers\Api\ProductApiController::class, 'show']);
    Route::get('/products', [App\Http\Controllers\Api\ProductApiController::class, 'productsByTenant']);

    Route::post('/client', [App\Http\Controllers\Api\Auth\RegisterController::class, 'store']);
});

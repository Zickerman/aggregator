<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProxyController;

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

// возможно стоит ограничить количество запросов
Route::get('/get-number', [ApiProxyController::class, 'getNumber']);
Route::get('/get-sms', [ApiProxyController::class, 'getSms']);
Route::get('/cancel-number', [ApiProxyController::class, 'cancelNumber']);
Route::get('/get-status', [ApiProxyController::class, 'getStatus']);
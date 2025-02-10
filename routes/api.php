<?php

use App\Http\Controllers\Api\CarroController;
use App\Http\Controllers\Api\LoginController;

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
Route::delete('carros', [CarroController::class, 'destroy'])->middleware('auth:api');
Route::delete('carros/{id}',[CarroController::class, 'destroyAll'])->middleware('auth:api');
Route::put('carros/', [CarroController::class, 'update'])->middleware('auth:api');

Route::apiResource('carros', CarroController::class)->except(['destroy','update']);

Route::post('login', [LoginController::class, 'login']);

<?php

use \App\Http\Controllers\Api\V1\UserController;
use \App\Http\Controllers\Api\V1\SubscriptionController;
use \App\Http\Controllers\Api\V1\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function() {
    Route::apiResource('/register', \App\Http\Controllers\Api\V1\UserController::class);
    Route::apiResource('/user', \App\Http\Controllers\Api\V1\UserController::class);
    Route::apiResource('/user/{id}/subscription', \App\Http\Controllers\Api\V1\SubscriptionController::class);
    Route::apiResource('/user/{id}/transaction', \App\Http\Controllers\Api\V1\TransactionController::class);
});

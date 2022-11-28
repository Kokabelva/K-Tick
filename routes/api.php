<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\OrderTiket;
use App\Http\Controllers\Api\User\PembayaranController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\User\EventController as UserEventController;



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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('admin')->group(function () {
        Route::resource('event', EventController::class);
    });

    Route::post('beli-tiket', [OrderTiket::class, 'store']);
    Route::get('beli-tiket', [OrderTiket::class, 'index']);
    Route::get('beli-tiket/{id}', [OrderTiket::class, 'show']);

    Route::post('pembayaran', [PembayaranController::class, 'store']);
    Route::get('pembayaran', [PembayaranController::class, 'index']);
    Route::get('pembayaran/{id}', [PembayaranController::class, 'show']);


    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('event', [UserEventController::class, 'index']);
Route::get('event/{id}', [UserEventController::class, 'show']);
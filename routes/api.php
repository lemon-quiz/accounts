<?php

use App\Http\Controllers\Api\AccountsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommandsController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\RolesController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('service')
    ->get('/profile', [AuthController::class, 'profile']);

Route::group(['middleware' => 'service'], function () {
    Route::get('/accounts', [AccountsController::class, 'index']);
    Route::post('/accounts', [AccountsController::class, 'create']);
    Route::get('/accounts/{id}', [AccountsController::class, 'view']);
    Route::put('/accounts/{id}', [AccountsController::class, 'update']);
    Route::delete('/accounts/{id}', [AccountsController::class, 'delete']);
    Route::delete('/accounts/{id}', [AccountsController::class, 'delete']);
    Route::post('/accounts/{id}/role', [AccountsController::class, 'role']);

    Route::get('events', [EventsController::class, 'index']);
    Route::resource('/roles', RolesController::class);
});

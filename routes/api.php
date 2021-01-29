<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
  return ['message' => 'Contaq Mock API`'];
});

Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/logout', [UserController::class, 'logout']);
Route::post('/users/forgot-password', [UserController::class, 'requestResetLink']);
Route::post('/users/reset-password', [UserController::class, 'reset']);
Route::apiResource('users', UserController::class)->only([
  'store', 'destroy'
]);
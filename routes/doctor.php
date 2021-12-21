<?php

use App\Http\Controllers\Api\Doctor\AuthController;
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

Route::post('doctor-login',[AuthController::class, 'doctorLogin'])->name('doctorLogin');
Route::post('doctor-register',[AuthController::class, 'doctorRegister'])->name('doctorRegister');

Route::middleware(["auth:api-doctor"])->group(function () {

    Route::post('forget-password',[AuthController::class, 'forgetPassword'])->name('forgetPassword');

});

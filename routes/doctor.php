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


Route::post('register',[AuthController::class, 'doctorRegister'])->name('doctorRegister');
Route::post('forget-password',[AuthController::class, 'forgetPassword'])->name('forgetPassword');


Route::middleware(["auth:api-doctor"])->group(function () {

    Route::post('change-password',[AuthController::class, 'changePassword'])->name('changePassword');
    Route::post('phone-verify',[AuthController::class, 'phoneVerify'])->name('PhoneVerify');


});

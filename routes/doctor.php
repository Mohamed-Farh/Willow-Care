<?php

use App\Http\Controllers\Api\Doctor\AuthController;
use App\Http\Controllers\Api\Doctor\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
// Route::get('/test', function () {
//     return Auth::user()->id;
// });


Route::post('register',[AuthController::class, 'doctorRegister'])->name('doctorRegister');
Route::post('forget-password',[AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('terms-conditions',[GeneralController::class, 'getTermsAndConditions']);


Route::middleware(["auth:api-doctor"])->group(function () {

    Route::post('change-password',[AuthController::class, 'changePassword']);
    Route::post('phone-verify',[AuthController::class, 'phoneVerify']);

    Route::get('specialties',[GeneralController::class, 'getSpecialties']);





});

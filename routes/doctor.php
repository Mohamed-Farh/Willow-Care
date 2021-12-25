<?php

use App\Http\Controllers\Api\Doctor\AuthController;
use App\Http\Controllers\Api\Doctor\CertificationController;
use App\Http\Controllers\Api\Doctor\ClinicController;
use App\Http\Controllers\Api\Doctor\GeneralController;
use App\Http\Controllers\Api\Doctor\LicenseController;
use App\Http\Controllers\Api\Doctor\ShiftController;
use App\Http\Controllers\Api\Doctor\SpecialtyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::post('register',[AuthController::class, 'doctorRegister'])->name('doctorRegister');
Route::post('forget-password',[AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('terms-conditions',[GeneralController::class, 'getTermsAndConditions']);


Route::middleware(["auth:api-doctor"])->group(function () {
    ########################## Auth #############################
    Route::post('change-password',[AuthController::class, 'changePassword']);
    Route::post('phone-verify',[AuthController::class, 'phoneVerify']);

    ############################# General ####################################
    Route::get('specialties',[GeneralController::class, 'getSpecialties']);
    //Specialty
    //Route::post('add-specialties',[SpecialtyController::class, 'addSpecialties']);

    ######################## Licenses AND Specialty ###############################
    Route::post('add-licenses',[LicenseController::class, 'addLicensesAndSpecialist']);

    ############################## CLINIC #####################################
    //add clinic
    Route::post('add-clinic',[ClinicController::class, 'addClinic']);
    // add Work Time & shifts
    Route::post('add_clinic_worktime',[ClinicController::class, 'addClinicWorkTime']);

});

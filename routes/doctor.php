<?php

use App\Http\Controllers\Api\Doctor\AuthController;
use App\Http\Controllers\Api\Doctor\CertificationController;
use App\Http\Controllers\Api\Doctor\ClinicController;
use App\Http\Controllers\Api\Doctor\GeneralController;
use App\Http\Controllers\Api\Doctor\LicenseController;
use App\Http\Controllers\Api\Doctor\ProfileController;
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
    Route::post('profile-image',[AuthController::class, 'changeProfileImage']);


    ############################# Profile ####################################
    Route::get('get-my-specialties',[ProfileController::class, 'getMySpecialties']);
    Route::get('get-professional-titles',[ProfileController::class, 'getProfessionalTitles']);
    Route::post('update-profile',[ProfileController::class, 'updateDoctorProfile']);

    ############################# General ####################################
    Route::get('specialties',[GeneralController::class, 'getSpecialties']);

    ######################## Licenses AND Specialty ###############################
    Route::post('add-licenses',[LicenseController::class, 'addLicensesAndSpecialist']);

    ############################# Certification #############################################
    Route::get('get-my-certifications',[CertificationController::class, 'getMyCertifications']);
    Route::post('add-certifications',[CertificationController::class, 'addCertifications']);
    Route::post('delete-certifications',[CertificationController::class, 'deleteCertifications']);

    ############################## CLINIC #####################################
    //add clinic
    Route::post('add-clinic',[ClinicController::class, 'addClinic']);


    // add Work Time & shifts
    Route::post('add_clinic_worktime',[ClinicController::class, 'addClinicWorkTime']);

});

<?php

use App\Http\Controllers\Api\Doctor\AuthController;
use App\Http\Controllers\Api\Doctor\BasicInformationController;
use App\Http\Controllers\Api\Doctor\CertificationController;
use App\Http\Controllers\Api\Doctor\ClinicController;
use App\Http\Controllers\Api\Doctor\GeneralController;
use App\Http\Controllers\Api\Doctor\HomeConcultationController;
use App\Http\Controllers\Api\Doctor\InsuranceCompanyController;
use App\Http\Controllers\Api\Doctor\LicenseController;
use App\Http\Controllers\Api\Doctor\OnlineConcultationController;
use App\Http\Controllers\Api\Doctor\ProfileController;
use App\Http\Controllers\dashboard\HomeDashboardController;
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
    Route::get('get-my-specialties',[BasicInformationController::class, 'getMySpecialties']);
    Route::get('get-professional-titles',[BasicInformationController::class, 'getProfessionalTitles']);
    Route::post('update-profile',[BasicInformationController::class, 'updateDoctorProfile']);


    ############################# Insurance Company ####################################
    Route::get('get-all-insurance-companies',[InsuranceCompanyController::class, 'getAllInsuranceCompanies']);
    Route::get('get-doctor-insurance-companies',[InsuranceCompanyController::class, 'getDoctorInsuranceCompanies']);
    Route::post('add-update-doctor-insurance-companies',[InsuranceCompanyController::class, 'addUpdateDoctorInsuranceCompanies']);
    Route::post('delete-doctor-insurance-companies',[InsuranceCompanyController::class, 'deleteDoctorInsuranceCompanies']);


    ############################# General ####################################
    Route::get('specialties',[GeneralController::class, 'getSpecialties']);


    ######################## Licenses AND Specialty ###############################
    Route::post('add-licenses',[LicenseController::class, 'addLicensesAndSpecialist']);
    Route::get('get-licenses',[LicenseController::class, 'getLicenses']);
    Route::post('delete-license',[LicenseController::class, 'deleteLicense']);


    ############################# Certification #############################################
    Route::get('get-my-certifications',[CertificationController::class, 'getMyCertifications']);
    Route::post('add-certifications',[CertificationController::class, 'addCertifications']);
    Route::post('delete-certifications',[CertificationController::class, 'deleteCertifications']);


    ############################## CLINIC #####################################
    //add clinic
    Route::get('get-clinic',[ClinicController::class, 'getClinic']);
    Route::post('add-clinic',[ClinicController::class, 'addClinic']);
    Route::post('update-clinic',[ClinicController::class, 'updateClinic']);
    Route::post('delete-clinic',[ClinicController::class, 'deleteClinic']);


    // add Work Time & shifts
    Route::post('add_clinic_worktime',[ClinicController::class, 'addClinicWorkTime']);


    ############################## Home Concultation ##################################################
    Route::get('get-home-concultation',[HomeConcultationController::class, 'getHomeConcultation']);
    Route::post('add-home-concultation',[HomeConcultationController::class, 'addHomeConcultation']);
    Route::post('update-home-concultation',[HomeConcultationController::class, 'updateHomeConcultation']);
    Route::post('delete-home-concultation',[HomeConcultationController::class, 'deleteHomeConcultation']);

            ########## Home ConcultationWorking Time ###########
            Route::get('get-home-free-times',[HomeConcultationController::class, 'getHomeFreeTimes']);
            Route::post('add-home-working-time',[HomeConcultationController::class, 'addHomeWorkingTime']);





    ############################## Online Concultation ###################################################
    Route::get('get-online-concultation',[OnlineConcultationController::class, 'getOnlineConcultation']);
    Route::post('add-online-concultation',[OnlineConcultationController::class, 'addOnlineConcultation']);
    Route::post('update-online-concultation',[OnlineConcultationController::class, 'updateOnlineConcultation']);
    Route::post('delete-online-concultation',[OnlineConcultationController::class, 'deleteOnlineConcultation']);

            ########## Online ConcultationWorking Time ###########
            Route::get('get-online-free-times',[OnlineConcultationController::class, 'getOnlineFreeTimes']);







});

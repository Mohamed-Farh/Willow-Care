<?php


use App\Http\Controllers\Dashboard\ProfessionalTitleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard\HomeDashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\SpecialityController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceCompanyController;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',function (){
    return view('soon');
});
Route::group(['prefix' => 'admin'], function(){
    Auth::routes(['register' => false]);
});


    Route::group(
        [
            'prefix' => \LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','Admin']
        ], function(){
            Route::group(['prefix'=>'admin'],function (){
                /*  Home   */
                Route::get('/', [HomeDashboardController::class,'index'])->name('home');
                /*  Category   */
                Route::resource('/categories', CategoryController::class);
                Route::post('delete-cat-img',[CategoryController::class,'deleteattachment'])->name('delCatImg');
                Route::post('categories/destroyAll', [CategoryController::class,'massDestroy'])->name('categories.massDestroy');
                Route::get('changeStatusCat', [CategoryController::class,'changeStatus'])->name('changeCatStatus');
                /*  Country   */
                Route::resource('/countries', CountryController::class);
                Route::post('delete-country-img',[CountryController::class,'deleteattachment'])->name('delCountryImg');
                Route::post('countries/destroyAll', [CountryController::class,'massDestroy'])->name('countries.massDestroy');
                Route::get('changeStatusCountry', [CountryController::class,'changeStatus'])->name('changeCountryStatus');
                /*  Admin   */
                Route::resource('/admin', AdminController::class);
                Route::get('changeStatusAdmin', [AdminController::class,'changeStatus'])->name('changeAdminStatus');
                Route::post('admin/destroyAll', [AdminController::class,'massDestroy'])->name('admins.massDestroy');
                Route::post('delete-admin-img',[AdminController::class,'deleteattachment'])->name('delAdminImg');
                Route::get('change-password/{id}',[AdminController::class,'showChangePassword'])->name('changePassword');
                Route::post('change-password/{id}',[AdminController::class,'changePassword'])->name('doChangePassword');
                /*  Professional Title   */
                Route::resource('/prof-title', ProfessionalTitleController::class);
                Route::get('changeStatusTitle', [ProfessionalTitleController::class,'changeStatus'])->name('changeTitleStatus');
                Route::post('prof-title/destroyAll', [ProfessionalTitleController::class,'massDestroy'])->name('titles.massDestroy');
                /* Speciality   */
                Route::resource('/speciality', SpecialityController::class);
                Route::get('changeStatusSpec', [SpecialityController::class,'changeStatus'])->name('changeSpecStatus');
                /* Doctor   */
                Route::resource('/doctor', DoctorController::class);
                Route::get('changeStatusDoctor', [DoctorController::class,'changeStatus'])->name('changeDoctorStatus');
                /* Insurance Company   */
                Route::resource('/insurance-company', InsuranceCompanyController::class);
                Route::get('changeStatusCompany', [InsuranceCompanyController::class,'changeStatus'])->name('changeCompanyStatus');
                Route::post('delete-company-img',[InsuranceCompanyController::class,'deleteattachment'])->name('delCompanyImg');
                Route::post('insurance-company/destroyAll', [InsuranceCompanyController::class,'massDestroy'])->name('company.massDestroy');
            });

    });







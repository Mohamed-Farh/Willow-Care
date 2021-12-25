<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\HomeDashboardController;


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




Route::group(['namespace' => 'admin'],function (){
    Route::group(
        [
            'prefix' => \LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
        ], function(){
            Route::group(['prefix'=>'admin'],function (){
                Route::get('/', [HomeDashboardController::class,'index'])->name('home');
            });

    });
});

Route::group(['prefix' => 'admin'], function(){
    Auth::routes(['register' => false]);
});








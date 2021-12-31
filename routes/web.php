<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\HomeDashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Auth;
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
    \Auth::routes(['register' => false]);
});
    Route::group(
        [
            'prefix' => \LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
        ], function(){
            Route::group(['prefix'=>'admin'],function (){
                /*  Home   */
                Route::get('/', [HomeDashboardController::class,'index'])->name('home');
                /*  Category   */
                Route::resource('/categories', CategoryController::class);
                Route::post('delete-cat-img',[CategoryController::class,'deleteattachment'])->name('delCatImg');
                Route::post('categories/destroyAll', [CategoryController::class,'massDestroy'])->name('categories.massDestroy');
                Route::get('changeStatusCat', [CategoryController::class,'changeStatus'])->name('changeCatStatus');
                /*  Category   */
            });

    });








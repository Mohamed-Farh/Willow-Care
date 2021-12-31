<?php


use Illuminate\Support\Facades\Route;




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



    Route::group(
        [
            'prefix' => \LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
        ], function(){
            Route::group(['prefix'=>'admin'],function (){
                /*  Home   */
                Route::get('/', [\App\Http\Controllers\dashboard\HomeDashboardController::class,'index'])->name('home');
                /*  Category   */
                Route::resource('/categories', \App\Http\Controllers\Dashboard\CategoryController::class);
                Route::post('delete-cat-img',[\App\Http\Controllers\Dashboard\CategoryController::class,'deleteattachment'])->name('delCatImg');
                Route::post('categories/destroyAll', [\App\Http\Controllers\Dashboard\CategoryController::class,'massDestroy'])->name('categories.massDestroy');
                Route::get('changeStatusCat', [\App\Http\Controllers\Dashboard\CategoryController::class,'changeStatus'])->name('changeCatStatus');
                /*  Category   */
            });

    });


Route::group(['prefix' => 'admin'], function(){
    \Auth::routes(['register' => false]);
});

Route::get('/',function (){
    return view('soon');
});






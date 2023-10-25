<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CompilationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.'], function () {
    //dashboard
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');

    Route::get('index_', 'DashboardController@index')->name('index_');

    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('submit-login', 'LoginController@submit')->name('postLogin');//->middleware('actch')
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/



    Route::group(['middleware' => ['admin']], function () {
      /*  Route::get('/', function () {

            return ("hdhskadjasdja");
        })->name('admin.index');*/
        //dashboard
       // Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
    Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {

        Route::get('/', [BannerController::class ,'index'])->name('index');
        Route::get('create', [BannerController::class ,'create'])->name('create');
        Route::post('store', 'BannerController@store')->name('store');
         Route::get('edit/{banner}', 'BannerController@edit')->name('edit');
         Route::post('update/{banner}', 'BannerController@update')->name('update');
         Route::get('status/{id}/{status}', 'BannerController@status')->name('status');
         Route::delete('delete/{banner}', 'BannerController@delete')->name('delete');
         Route::post('search', 'BannerController@search')->name('search');
    });
    Route::group(['prefix' => 'compilation', 'as' => 'compilation.'], function () {

        Route::get('/', [CompilationController::class ,'index'])->name('index');
        Route::get('create', [CompilationController::class ,'create'])->name('create');
        Route::post('store', 'CompilationController@store')->name('store');
        Route::get('edit/{id}', 'CompilationController@edit')->name('edit');
        Route::post('update/{id}', 'CompilationController@update')->name('update');
        Route::get('status/{id}/{status}', 'CompilationController@status')->name('status');
        Route::delete('delete/{id}', 'CompilationController@delete')->name('delete');
        Route::post('search', 'CompilationController@search')->name('search');
    });

    Route::group(['prefix' => 'place', 'as' => 'place.'], function () {

        Route::get('/', [PlaceController::class ,'index'])->name('index');
        Route::get('create', [PlaceController::class ,'create'])->name('create');
        Route::post('store', 'PlaceController@store')->name('store');
        Route::get('edit/{id}', 'PlaceController@edit')->name('edit');
        Route::post('update/{id}', 'PlaceController@update')->name('update');
        Route::get('status/{id}/{status}', 'PlaceController@status')->name('status');
        Route::delete('delete/{id}', 'PlaceController@delete')->name('delete');
        Route::post('search', 'PlaceController@search')->name('search');
    });

});


<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.'], function () {
    Route::get('index_', 'DashboardController@index')->name('index_');
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('submit-login', 'LoginController@submit')->name('postLogin');//->middleware('actch')
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/



    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', function () {

            return ("hdhskadjasdja");
        })->name('admin.index');
        //dashboard
       // Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
    Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {

        Route::get('/', 'BannerController@index')->name('add-new');
        /* Route::post('store', 'BannerController@store')->name('store');
         Route::get('edit/{banner}', 'BannerController@edit')->name('edit');
         Route::post('update/{banner}', 'BannerController@update')->name('update');
         Route::get('status/{id}/{status}', 'BannerController@status')->name('status');
         Route::delete('delete/{banner}', 'BannerController@delete')->name('delete');
         Route::post('search', 'BannerController@search')->name('search');*/
    });

});


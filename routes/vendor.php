<?php

use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'App\Http\Controllers\Vendor', 'as' => 'vendor.'], function () {

    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('submit-login', 'LoginController@submit')->name('postLogin');//->middleware('actch')
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/

    Route::group(['middleware' => ['vendor']], function () {
        //dashboard
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');

        Route::get('index_', 'DashboardController@index')->name('index_');
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {

            Route::get('/', [CategoryController::class ,'index'])->name('index');
            Route::get('create', [CategoryController::class ,'create'])->name('create');
            Route::post('store', 'CategoryController@store')->name('store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('update/{id}', 'CategoryController@update')->name('update');
            Route::get('status/{id}/{status}', 'CategoryController@status')->name('status');
            Route::post('change_status', 'CategoryController@change_status')->name('change-status');
            Route::delete('delete/{id}', 'CategoryController@destroy')->name('delete');
            Route::post('search', 'CategoryController@search')->name('search');
        });

        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {

            Route::get('/', [ProductController::class ,'index'])->name('index');
            Route::get('create', [ProductController::class ,'create'])->name('create');
            Route::post('store', 'ProductController@store')->name('store');
            Route::get('edit/{id}', 'ProductController@edit')->name('edit');
            Route::post('update/{id}', 'ProductController@update')->name('update');
            Route::get('status/{id}/{status}', 'ProductController@status')->name('status');
            Route::post('change_status', 'ProductController@change_status')->name('change-status');
            Route::get('view/{id}', 'ProductController@details')->name('view');
            Route::delete('delete/{id}', 'ProductController@destroy')->name('delete');
            Route::post('search', 'ProductController@search')->name('search');
        });
    });

  /*  Route::group(['middleware' => ['vendor']], function () {
        Route::get('/', function () {
            return ("hdhskadjasdja");
        })->name('admin.index');
        //dashboard
        // Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    });*/
});


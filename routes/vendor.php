<?php
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
        Route::get('/', function () {
            return ("hdhskadjasdja");
        })->name('admin.index');
        //dashboard
        // Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
});


<?php

use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CompilationController;
use App\Http\Controllers\Api\V1\FoodController;
use App\Http\Controllers\Api\V1\RestaurantController;
use App\Http\Controllers\Api\V1\ZoneController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Api\V1'], function () {


   /* Route::get('zone/list', 'ZoneController@get_zones');
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('sign-up', 'CustomerAuthController@register');
        Route::post('login', 'CustomerAuthController@login');
        Route::post('verify-phone', 'CustomerAuthController@verify_phone');

        Route::post('check-email', 'CustomerAuthController@check_email');
        Route::post('verify-email', 'CustomerAuthController@verify_email');
*/
      /*  Route::post('forgot-password', 'PasswordResetController@reset_password_request');
        Route::post('verify-token', 'PasswordResetController@verify_token');
        Route::put('reset-password', 'PasswordResetController@reset_password_submit');*/
    //});
});

/* get zones*/
Route::get('/zones', [ZoneController::class, 'get_zones']);
Route::get('/get-banner', [BannerController::class, 'get_banner']);
Route::namespace('Api\V1')->prefix('category')->group (function() {


    Route::get('/list', [CategoryController::class, 'list_cats']);
    Route::get('/get-cat/{id?}', [CategoryController::class, 'get_category'])->name('get-cat');

});

Route::namespace('Api\V1')->prefix('restaurants')->group (function() {


    Route::get('/list', [RestaurantController::class, 'list_rest'])->name('restaurants');
    Route::get('/popular', [RestaurantController::class, 'get_popular_restaurants'])->name('popular-restaurants');
    Route::get('/details/{id}', [RestaurantController::class, 'get_details'])->name('details-restaurants');
    Route::get('/latest', [RestaurantController::class, 'get_latest'])->name('latest-restaurants');

});

Route::namespace('Api\V1')->prefix('compilations')->group (function() {
    Route::get('/list', [CompilationController::class, 'list'])->name('list-compilaions');
});

Route::namespace('Api\V1')->prefix('food')->group (function() {
    Route::get('/list', [FoodController::class, 'get_food'])->name('list-food');
    Route::get('/single-food', [FoodController::class, 'single_food'])->name('single-food');
});
Route::namespace('Api\V1')->prefix('order')->group (function() {
    Route::get('/list', [orderController::class, ''])->name('list-food');
    Route::get('/single-food', [FoodController::class, 'single_food'])->name('single-food');
});
/*get banners*/







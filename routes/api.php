<?php

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BoardingController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RatingsController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PoliciesController;
use Illuminate\Support\Facades\Route;


//Auth Routes

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('profile', 'getProfile')->middleware('auth:api');
    Route::post('profile', 'updateProfile')->middleware('auth:api');
    Route::post('change-password', 'changePassword')->middleware('auth:api');
});

//Auth Routes


Route::controller(ServicesController::class)->group(function () {
    Route::get('services', 'index');
    Route::get('services/{id}', 'show');
    Route::get('bestsellers', 'bestsellers');
    Route::get('new-services', 'newServices');
    Route::get('top-sales', 'topSales');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('categories/{id}', 'show');
    Route::get('categories/{category}/services', 'services');
});

Route::get('boarding' , [BoardingController::class , 'index']);
Route::get('contact' , [ContactUsController::class , 'index']);
Route::get('policies' , [PoliciesController::class , 'index']);


// Authentication Needed Routes
Route::middleware('auth:api')->group(function () {

    Route::controller(RatingsController::class)->group(function () {
        Route::post('service/{service}/rating', 'store');
        Route::get('service/{service}/rating', 'show');
    });

    Route::controller(CouponController::class)->group(function () {
        Route::post('coupon', 'submit');
        Route::post('check-coupon', 'check');
    });

    Route::controller(CartController::class)->group(function () {
        Route::post('cart/{id}', 'addToCart');
        Route::get('cart', 'index');
        Route::patch('cart/decrease-quantity/{id}', 'decrease');
        Route::delete('cart', 'destroy');
        Route::delete('cart/remove/{id}', 'removeItem');

        Route::post('cart/extra/{id}', 'addExtraToCart');

    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index');
        Route::post('orders', 'store');
        Route::get('orders/{order}', 'show');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('notifications', 'index');
    });
});

Route::controller(AdsController::class)->group(function () {
    Route::get('ads' , 'index');
});




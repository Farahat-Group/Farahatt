<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\NoticicationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RatingsController;
use App\Http\Controllers\Api\ServicesController;
use Illuminate\Support\Facades\Route;


//Auth Routes

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('profile', 'getProfile')->middleware('auth:api');
    Route::post('profile', 'updateProfile')->middleware('auth:api');
});

//Auth Routes


Route::controller(ServicesController::class)->group(function () {
    Route::get('services', 'index');
    Route::get('services/{id}', 'show');
    Route::get('bestsellers', 'bestsellers');
    Route::get('new-services', 'newServices');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('categories/{id}', 'show');
    Route::get('categories/{category}/services', 'services');
});




// Authentication Needed Routes
Route::middleware('auth:api')->group(function () {

    Route::controller(RatingsController::class)->group(function () {
        Route::post('service/{service}/rating', 'store');
        Route::get('service/{service}/rating', 'show');
    });

    Route::controller(CouponController::class)->group(function () {
        Route::post('coupon', 'submit');
    });

    Route::controller(CartController::class)->group(function () {
        Route::post('cart/{id}', 'addToCart');
        Route::get('cart', 'index');
        Route::patch('cart/decrease-quantity/{id}', 'decrease');
        Route::delete('cart', 'destroy');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index');
        Route::post('orders', 'store');
        Route::get('orders/{order}', 'show');
    });

    Route::controller(NoticicationController::class)->group(function () {

        Route::get('notifications', 'index');
    });
});

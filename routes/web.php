<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\admin\CustomersController;
use App\Http\Controllers\admin\ExtraServicesController;
use App\Http\Controllers\admin\NotificationsController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\Api\BoardingController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PoliciesController;
use App\Http\Controllers\ServicesController;
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


Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::controller(CustomersController::class)->group(function () {
        Route::get('customers', 'index');
        Route::delete('customers/{id}', 'delete')->name('customer.delete');
    });

    Route::controller(AdminsController::class)->group(function () {
        Route::get('admins', 'index');
    });


    Route::controller(CategoriesController::class)->group(function () {
        Route::get('categories' , 'index')->name('categories.index');
        Route::get('categories/edit/{id}' , 'edit');
        Route::get('categories/create' , 'create');
        Route::post('categories' , 'store');
        Route::put('categories/{id}' , 'update');
        Route::delete('categories/{id}' , 'delete')->name('categories.delete');
    });

    Route::resource('services' , ServicesController::class);

    Route::controller(AdsController::class)->group(function () {
       Route::get('ads' , 'index')->name('ads.index');
       Route::get('ads/create' , 'create');
       Route::get('ads/edit/{id}' , 'edit');
       Route::put('ads/{id}' , 'update');
       Route::post('ads' , 'store');
       Route::delete('ads/{id}' , 'destroy')->name('ads.delete');
    });

    Route::controller(ContactUsController::class)->group(function () {
        Route::get('/contact-us' , 'all');
        Route::get('contact/edit/{id}' , 'edit');
        Route::put('contact/{id}' , 'update');
        Route::delete('contact/{id}' , 'destroy')->name('contacts.delete');
    });

    Route::controller(BoardingController::class)->group(function () {
        Route::get('/boarding' , 'all');
        Route::get('board/edit/{id}' , 'edit');
        Route::put('boards/{id}' , 'update');
        Route::delete('boards/{id}' , 'destroy')->name('boards.delete');
    });

    Route::controller(ExtraServicesController::class)->group(function () {
        Route::get('/extra-services' , 'index');
        Route::get('/extra-services/create' , 'create');
        Route::post('/extra-services' , 'store');
        Route::get('/extra-services/edit/{id}' , 'edit');
        Route::put('/extra-services/{id}' , 'update');
        Route::delete('/extra-services/{id}' , 'destroy')->name('extra-services.destroy');
    });

    Route::controller(NotificationsController::class)->group(function () {
        Route::get('notifications' , 'index');
        Route::get('notifications/create' , 'create');
        Route::post('notifications' , 'store');
        Route::delete('notifications/{id}' , 'destroy')->name('notifications.destroy');
    });

    Route::controller(OrdersController::class)->group(function () {
        Route::get('orders' , 'index')->name('orders.index');
        Route::get('orders/{id}' , 'show')->name('orders.show');
        Route::delete('orders/{id}' , 'destroy')->name('orders.destroy');
        Route::get('orders/accept/{id}' , 'active');
    });

    Route::controller(CouponController::class)->group(function (){
        Route::get('coupon' , 'index')->name('coupon.index');
        Route::get('coupon/create' , 'create');
        Route::post('coupons' , 'store');
        Route::delete('coupons/{id}' , 'destroy')->name('coupons.destroy');
    });

    Route::get('policy' , [PoliciesController::class , 'show']);
    Route::get('policy/edit/{id}' , [PoliciesController::class , 'edit']);
    Route::put('policy' , [PoliciesController::class , 'update']);
});

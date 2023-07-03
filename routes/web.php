<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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


Route::get('/',[AdminController::class,'welcome'])->name('welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Routes

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admindashboard',[AdminController::class,'index'])->name('admindashboard');
    Route::get('/order_details/{id}',[AdminController::class,'order_details'])->name('order_details');
    Route::post('/order_change_status', [AdminController::class,'changeStatus'])->name('changeStatus');
    
    //Products
    Route::resource('products', ProductController::class);
    Route::get('/products/delete/{id}',[ProductController::class,'delete'])->name('products.delete');
    });

Route::middleware(['auth'])->group(function () {
    Route::post('/add_to_cart',[CartController::class,'add_to_cart'])->name('add_to_cart');
    Route::get('/cart_list',[CartController::class,'cart_list'])->name('cart_list');
    Route::post('/remove_cart',[CartController::class,'remove_cart'])->name('remove_cart');
    Route::get('/order_now',[OrderController::class,'order_now'])->name('order_now');
    Route::post('/order_confirm',[OrderController::class,'order_confirm'])->name('order_confirm');
    Route::get('/order_list',[OrderController::class,'order_list'])->name('order_list');
    Route::get('payment', [PaymentController::class,'index'])->name('payment');
    Route::post('payment',[PaymentController::class,'payment'])->name('paymentSubmit');
    Route::get('returnurl',[PaymentController::class,'returnurl'])->name('returnurl');
    });




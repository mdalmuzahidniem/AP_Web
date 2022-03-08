<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[CustomerController::class,'login'])->name('login');

Route::get('/needlogin',[CustomerController::class,'needLogin'])->name('needLogin');
Route::post('/login',[CustomerController::class,'loginSubmit'])->name('loginSubmit');

Route::get('/registration',[CustomerController::class,'registration'])->name('registration');
Route::post('/regSubmit',[CustomerController::class,'regSubmit'])->name('regSubmit');

Route::get('/products',[CustomerController::class,'products'])->name('products');
Route::post('/searchproduct',[CustomerController::class,'search'])->name('search');

Route::get('/cart',[CustomerController::class,'cart'])->middleware('loggedInCustomer')->name('cart');

Route::get('/orderhistory',[CustomerController::class,'orderHistory'])->middleware('loggedInCustomer')->name('order.history');
Route::get('/myProfile',[CustomerController::class,'profile'])->middleware('loggedInCustomer')->name('myProfile');
Route::post('/myProfile',[CustomerController::class,'updateProfile'])->name('update');

Route::get('/emptycart',[CustomerController::class,'emptyCart'])->name('emptyCart');
Route::get('/addtocart/{id}',[CustomerController::class,'addtocart'])->name('addtocart');
Route::get('/cartIncrease/{id}',[CustomerController::class,'increase'])->name('increase');
Route::get('/cartDecrease/{id}',[CustomerController::class,'decrease'])->name('decrease');
Route::get('/checkout',[CustomerController::class,'checkout'])->middleware('loggedInCustomer')->name('checkout');

Route::get('/viewDetails/{id}',[CustomerController::class,'viewDetails'])->name('viewDetails');
Route::get('/removeOrder/{id}',[CustomerController::class,'removeOrder'])->name('removeOrder');
Route::get('/deleteAccount/{id}',[CustomerController::class,'deleteAccount'])->name('deleteAccount');

Route::get('/logout',[CustomerController::class,'logout'])->name('logout');
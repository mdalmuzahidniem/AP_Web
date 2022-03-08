<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\LoginApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[CustomerApiController::class,'login']);

Route::get('/product/list',[CustomerApiController::class,'products']);

Route::get('/search/product',[CustomerApiController::class,'search']);
Route::get('/cart',[CustomerApiController::class,'cart'])->middleware('APIAuth');
Route::get('/addtocart',[CustomerApiController::class,'addtocart'])->middleware('APIAuth');
Route::get('/cartIncrease/{id}',[CustomerApiController::class,'increase']);
Route::get('/cartDecrease/{id}',[CustomerApiController::class,'decrease']);
Route::get('/emptycart',[CustomerApiController::class,'emptyCart']);
Route::post('/checkout',[CustomerApiController::class,'checkout'])->middleware('APIAuth');
Route::get('/orderhistory',[CustomerApiController::class,'orderHistory'])->middleware('APIAuth');
Route::get('/viewDetails',[CustomerApiController::class,'viewDetails'])->middleware('APIAuth');
Route::get('/removeOrder',[CustomerApiController::class,'removeOrder'])->middleware('APIAuth');
Route::get('/myProfile',[CustomerApiController::class,'profile'])->middleware('APIAuth');
Route::post('/myProfile',[CustomerApiController::class,'updateProfile'])->middleware('APIAuth');
Route::get('/deleteAccount/{id}',[CustomerApiController::class,'deleteAccount']);
Route::get('/logout',[CustomerApiController::class,'logout'])->name('logout');
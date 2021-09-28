<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pagescontroller;
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
Route::get('/contact',[Pagescontroller::class,'contact']);
Route::get('/profile',[Pagescontroller::class,'profile']);
Route::get('/login',[Pagescontroller::class,'login']);
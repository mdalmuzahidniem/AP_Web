<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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
//create
Route::get('/create',[PagesController::class,'create'])->name('create');
Route::post('/create',[PagesController::class,'createSubmit'])->name('createSubmit');
//view
Route::get('/view',[PagesController::class,'view'])->name('view');
//edit
Route::get('/edit/{id}',[PagesController::class,'edit'])->name('edit');
Route::post('/edit',[PagesController::class,'editSubmit'])->name('editSubmit');
//delete
Route::get('/delete/{id}',[PagesController::class,'delete'])->name('delete');
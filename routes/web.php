<?php

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/create', [App\Http\Controllers\ProductController::class, 'showListCreate'])->name('showList.create');
Route::post('/create', [App\Http\Controllers\ProductController::class, 'createProduct'])->name('product.store');
Route::get('/detail{id}', [App\Http\Controllers\ProductController::class, 'showListDetail'])->name('showList.detail');
Route::get('/edit{id}', [App\Http\Controllers\ProductController::class, 'showListEdit'])->name('showList.edit');
Route::post('/update{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::post('/delete', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
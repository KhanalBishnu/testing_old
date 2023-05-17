<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controller(ProductController::class)->group(function () {

    Route::get('/product',  'index');
    Route::get('/product/create','create');
    Route::post('/product', 'show');
    Route::get('/product/{productId}/edit', 'edit');
    Route::put('/product/{productId}', 'update');
    Route::get('/product/{productId}/delete', 'delete');
});
Route::controller(EventController::class)->group(function () {

    Route::get('/event',  'index');
    Route::get('/event/create','create');
    Route::post('/event', 'show');
    Route::get('/event/edit/{id}', 'edit')->name('events.edit');
    Route::post('events/delete-file', 'deleteFile')->name('events.deleteFile');

    Route::put('/event/{id}', 'update');
    Route::delete('/product/delete/{id}', 'delete')->name('event.destroy');
});
Route::controller(BrandController::class)->group(function () {

    Route::get('/brand',  'index');
    Route::get('/brand/create','create')->middleware(['role:Admin']);
    Route::post('/brand', 'show');
    Route::get('/product/{productId}/edit', 'edit');
    Route::put('/product/{productId}', 'update');
    Route::get('/product/{productId}/delete', 'delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

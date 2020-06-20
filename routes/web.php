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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/{product:slug}', 'ProductController@show')->name('products.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

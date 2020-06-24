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

Route::middleware('auth')->prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::post('/{product}', 'CartController@store')->name('cart.store');
    Route::put('/{product}', 'CartController@update')->name('cart.update');
    Route::delete('/{product}', 'CartController@destroy')->name('cart.destroy');
});

Route::middleware('auth')->get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::middleware('auth')->post('/checkout', 'CheckoutController@store')->name('checkout.store');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

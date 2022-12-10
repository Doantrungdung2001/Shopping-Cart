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
Route::get('/', 'App\Http\Controllers\CartController@Index');
Route::get('/AddCart/{id}', 'App\Http\Controllers\CartController@AddCart');
Route::get('/Delete-Item-Cart/{id}', 'App\Http\Controllers\CartController@DeleteItemCart');
Route::get('/Cart', 'App\Http\Controllers\CartController@ViewCart');
Route::get('/Delete-Item-List-Cart/{id}', 'App\Http\Controllers\CartController@DeleteItemListCart');
Route::get('/Save-Item-List-Cart/{id}/{quanty}', 'App\Http\Controllers\CartController@SaveItemListCart');
/*
Route::get('/home', function () {
    return view('home');
});
*/
Route::get('/cart', function () {
    return view('cart');
});

Route::get('/dashboard', 'App\Http\Controllers\DashBoardController@Index');
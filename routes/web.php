<?php

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

use Illuminate\Support\Facades\Auth;

Route::get('/test/', function(){
    return "<img src='".asset('storage/image/product/product-25.png')."'>";
});
Auth::routes();
Route::get('/auth', function(){
   return Auth::user();
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{any}', 'AdminController@index')->where('any', '.*')->middleware('auth');

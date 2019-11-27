<?php

use App\Product;
use App\User;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user', 'UserController');
Route::resource('product', 'ProductController');
Route::resource('product-category', 'ProductCategoryController');
Route::resource('brand', 'BrandController');
Route::resource('store', 'StoreController');
Route::resource('item', 'ItemController');

Route::group(['prefix' => 'search', 'as' => 'search'], function(){
    Route::get('/user/{key}/{value}', function($key, $value){
        return User::where($key, $value)->get();
//       return User::where('')
    });
    Route::get('/product/{key}/{value}', function($key, $value){
        return Product::where($key, 'LIKE', "%$value%")->get();
    });
});
Route::get('/test', function(){
    $data = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAA...';
    $data = explode(';', explode('/', explode(',', $data)[0])[1])[0];
    return $data;
});

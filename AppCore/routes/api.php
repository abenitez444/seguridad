<?php

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

#========== API de la tienda ==========#
Route::group(['prefix' => 'v1'], function(){
	Route::post('/registro-client', 'api\UserController@registroClient');
	Route::post('/registro-chef', 'api\UserController@registroChef')->name('api.website.registroChef');
	Route::get('/cooks/{id_cook}/getServices/', 'api\Cook\ServiceController@getServices');

	Route::post('/delete-cart', 'api\CartController@deleteCart')->name('api.deleteCart');

	Route::get('/get-methods-pay/{id_cart}', 'api\UserController@getMethodsPay');
});

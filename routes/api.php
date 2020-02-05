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
Route::get('/login', 'apiController@login');
Route::post('/submit', 'apiController@submit');
Route::post('/updateUser', 'apiController@updateUser');
Route::get('/forget_password', 'apiController@forget_Password');
Route::post('/reset_password', 'apiController@reset_password');
Route::post('/change_password', 'apiController@change_password');

Route::get('/services', 'apiController@services');
Route::get('/subServices', 'apiController@subServices');
Route::post('/order', 'apiController@order');
Route::get('/userOrders', 'apiController@userOrders');
Route::get('/orderInfo', 'apiController@orderInfo');
Route::get('/perviousOrders', 'apiController@perviousOrders');
Route::get('/perviousOrderInfo', 'apiController@perviousOrderInfo');



Route::get('/offers', 'apiController@offers');
Route::post('/offerAccept', 'apiController@offerAccept');
Route::get('/worker', 'apiController@offerAccept');
Route::get('/workerInfo', 'apiController@workerInfo');
Route::get('/workerComment', 'apiController@workerComment');









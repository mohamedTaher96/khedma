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


//user login_controller
Route::get('/login', 'api\user\loginController@login')->middleware('localization');
Route::get('/phoneVerification', 'api\user\loginController@phoneVerification')->middleware('localization');
Route::post('/register', 'api\user\loginController@register')->middleware('localization');
Route::post('/updateUser', 'api\user\loginController@updateUser')->middleware('localization');
Route::get('/forget_password', 'api\user\loginController@forget_Password')->middleware('localization');
Route::put('/reset_password', 'api\user\loginController@reset_password')->middleware('localization');



//order_controller
Route::get('/services', 'api\user\orderController@services');
Route::get('/subServices', 'api\user\orderController@subServices');
Route::post('/order', 'api\user\orderController@order');
Route::get('/userOrders', 'api\user\orderController@userOrders');
Route::get('/orderInfo', 'api\user\orderController@orderInfo');
Route::get('/perviousOrders', 'api\user\orderController@perviousOrders');
Route::get('/perviousOrderInfo', 'api\user\orderController@perviousOrderInfo');


//odder_controller
Route::get('/offers', 'api\user\offerController@offers');
Route::post('/offerAccept', 'api\user\offerController@offerAccept');

//worker_controller
Route::get('/worker', 'api\user\workerController@offerAccept');
Route::get('/workerInfo', 'api\user\workerController@workerInfo');
Route::get('/workerComment', 'api\user\workerController@workerComment');

//user_controller
Route::get('/userInfo', 'api\user\userController@userInfo');
Route::put('/updateUserInfo', 'api\user\userController@updateUserInfo');
Route::put('/change_password', 'api\user\userController@change_password');


//app_controller
Route::get('/contact', 'api\user\appController@contact');
Route::get('/about', 'api\user\appController@about');
Route::get('/policy', 'api\user\appController@policy');
Route::post('/message', 'api\user\appController@message');





//worker login controller
Route::get('/worker/login', 'api\worker\loginController@login')->middleware('localization');
Route::get('/worker/phoneVerification', 'api\worker\loginController@phoneVerification')->middleware('localization');
Route::post('/worker/register', 'api\worker\loginController@register')->middleware('localization');
Route::post('/updateUser', 'api\user\loginController@updateUser')->middleware('localization');
Route::get('/worker/forget_password', 'api\worker\loginController@forget_Password')->middleware('localization');
Route::put('/worker/reset_password', 'api\worker\loginController@reset_password')->middleware('localization');

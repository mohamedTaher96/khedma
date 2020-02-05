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

Route::get('/', 'adminController@home');
//page control
Route::get('/pages', 'adminController@pages')->defaults('page','textEditors');
Route::get('/pages/ar', 'adminController@ArTextEditors');
Route::get('/pages/en', 'adminController@EnTextEditors');
Route::get('/contact', 'adminController@pages')->defaults('page','contact');

//workers
Route::get('/workers', 'adminController@workers');
Route::get('/worker/new', 'adminController@pages')->defaults('page','newWorker');
Route::post('/worker/new/add', 'adminController@addNewWorker');

//services
Route::get('/services', 'adminController@services');
Route::get('/service/new', 'adminController@pages')->defaults('page','newService');
Route::post('/service/new/add', 'adminController@addNewService');
Route::get('/services/sub/{id}', 'adminController@subServices');
Route::get('/services/sub/new/{id}', 'adminController@newSubService');
Route::post('/services/sub/new/add', 'adminController@addNewSubservice');










Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
// Route::prefix('app')->group(function () {
//     // Registration routes
//     Route::get('registration/create', 'RegistrationController@create')->name('app-registration-form');
// });

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    echo "done";
});

Route::get('/', 'admin\adminController@home');
//page control
Route::get('/pages', 'admin\adminController@pages')->defaults('page','textEditors');
Route::get('/pages/ar', 'admin\adminController@ArTextEditors');
Route::get('/pages/en', 'admin\adminController@EnTextEditors');
Route::get('/contact', 'admin\adminController@contact');
Route::put('/pages/ar/about/update', 'admin\adminController@arTextChange')->defaults('page','about');
Route::put('/pages/ar/policy/update', 'admin\adminController@arTextChange')->defaults('page','policy');
Route::put('/pages/en/about/update', 'admin\adminController@enTextChange')->defaults('page','about');
Route::put('/pages/en/policy/update', 'admin\adminController@enTextChange')->defaults('page','policy');


//workers
Route::get('/workers', 'admin\adminController@workers');
Route::get('/worker/new', 'admin\adminController@pages')->defaults('page','newWorker');
Route::post('/worker/new/add', 'admin\adminController@addNewWorker');

//services
Route::get('/services', 'admin\adminController@services');
Route::get('/service/new', 'admin\adminController@pages')->defaults('page','newService');
Route::post('/service/new/add', 'admin\adminController@addNewService');
Route::get('/services/sub/{id}', 'admin\adminController@subServices');
Route::get('/services/sub/new/{id}', 'admin\adminController@newSubService');
Route::post('/services/sub/new/add', 'admin\adminController@addNewSubservice');










Auth::routes();



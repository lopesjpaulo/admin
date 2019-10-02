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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::resource('news', 'NewsController');
    Route::post('/news/{id}', 'NewsController@update');

    Route::resource('vitrines', 'VitrineController');
    Route::post('/vitrines/{id}', 'VitrineController@update');

    Route::resource('users', 'UserController');
    Route::post('/users/{id}', 'UserController@update');

    Route::resource('roles', 'RoleController');
    Route::post('/roles/{id}', 'RoleController@update');

    Route::resource('contacts', 'ContactController');
    Route::post('/contacts/{id}', 'ContactController@update');
});

Auth::routes();


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

    Route::resource('clients', 'ClientsController');
    Route::post('/clients/{id}', 'ClientsController@update');

    Route::resource('hosts', 'HostsController');
    Route::post('/hosts/{id}', 'HostsController@update');

    Route::resource('attendances', 'AttendancesController');
    Route::post('/attendances/{id}', 'AttendancesController@update');

    Route::resource('hostings', 'HostingsController');
    Route::post('/hostings/{id}', 'HostingsController@update');
    Route::get('/hostings/mail/{id}', 'HostingsController@mail');

    Route::resource('news', 'NewsController');
    Route::post('/news/{id}', 'NewsController@update');

    Route::resource('disciplines', 'DisciplineController');
    Route::post('/disciplines/{id}', 'DisciplineController@update');

    Route::resource('themes', 'ThemeController');
    Route::post('/themes/{id}', 'ThemeController@update');

    Route::resource('types', 'TypeController');
    Route::post('/types/{id}', 'TypeController@update');

    Route::resource('classes', 'ClasseController');
    Route::post('/classes/{id}', 'ClasseController@update');

    Route::resource('maps', 'MapController');
    Route::post('/maps/{id}', 'MapController@update');

    Route::post('/questions/findType', 'QuestionController@findType');
    Route::resource('questions', 'QuestionController');
    Route::post('/questions/{id}', 'QuestionController@update');

    Route::resource('users', 'UserController');
    Route::post('/users/{id}', 'UserController@update');

    Route::resource('roles', 'RoleController');
    Route::post('/roles/{id}', 'RoleController@update');

    Route::post('/tests/findQuestion', 'TestController@findQuestion');
    Route::resource('tests', 'TestController');
    Route::post('/tests/{id}', 'TestController@update');
});

Auth::routes();


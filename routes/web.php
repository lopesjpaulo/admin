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

Route::group(['middleware' => ['auth', 'log'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::resource('categorias', 'CategoriaController')->middleware('can:read_catorganizacoes');
    Route::post('/categorias/{id}', 'CategoriaController@update');

    Route::resource('contatos', 'ContactController')->middleware('can:read_contatos');

    Route::resource('files', 'FileController')->middleware('can:read_arquivos');
    Route::post('/files/{id}', 'FileController@update');
    Route::get('/files/{id}/share', 'FileController@share')->name('files.share');
    Route::post('/files/{id}/share', 'FileController@storeshare')->name('files.storeshare');

    Route::resource('logs', 'LogController')->middleware('can:read_logs');

    Route::resource('modules', 'ModuleController')->middleware('can:read_modulos');
    Route::post('/modules/{id}', 'ModuleController@update');

    Route::resource('months', 'MonthController')->middleware('can:read_meses');
    Route::post('/months/{id}', 'MonthController@update');

    Route::resource('news', 'NewsController')->middleware('can:read_noticias');
    Route::post('/news/{id}', 'NewsController@update');

    Route::resource('reports', 'ReportController')->middleware('can:read_relatorios');
    Route::post('/reports/{id}', 'ReportController@update');
    Route::get('/reports/{id}/print', 'ReportController@generatePDF')->name('reports.print');

    Route::resource('roles', 'RoleController')->middleware('can:read_grupos');
    Route::post('/roles/{id}', 'RoleController@update');

    Route::resource('search', 'SearchController')->middleware('can:read_pesquisar');

    Route::resource('tags', 'TagController')->middleware('can:read_tags');
    Route::post('/tags/{id}', 'TagController@update');

    Route::resource('users', 'UserController')->middleware('can:read_usuarios');
    Route::post('/users/{id}', 'UserController@update');

    Route::resource('vitrines', 'VitrineController')->middleware('can:read_vitrines');
    Route::post('/vitrines/{id}', 'VitrineController@update');

    Route::resource('years', 'YearController')->middleware('can:read_anos');
    Route::post('/years/{id}', 'YearController@update');
});

Auth::routes();


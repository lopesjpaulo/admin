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

    Route::get('/link', function () {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
    });

    Route::resource('users', 'UserController');
    Route::post('/users/{id}', 'UserController@update');

    Route::resource('roles', 'RoleController')->middleware('can:read_grupos');
    Route::post('/roles/{id}', 'RoleController@update');

    Route::post('/organizacoes/findCatorganizacao', 'OrganizacaoController@findCatorganizacao');
    Route::resource('organizacoes', 'OrganizacaoController')->middleware('can:read_organizacoes');
    Route::post('/organizacoes/{id}', 'OrganizacaoController@update');

    Route::resource('catorganizacoes', 'CatorganizacaoController')->middleware('can:read_organizacoes');
    Route::post('/catorganizacoes/{id}', 'CatorganizacaoController@update');

    Route::post('/categorias/findSubcategoria', 'CategoriaController@findSubcategoria');
    Route::resource('categorias', 'CategoriaController')->middleware('can:read_catorganizacoes');
    Route::post('/categorias/{id}', 'CategoriaController@update');

    Route::resource('subcategorias', 'SubcategoriaController')->middleware('can:read_subcategorias');
    Route::post('/subcategorias/{id}', 'SubcategoriaController@update');

    Route::resource('tags', 'TagController')->middleware('can:read_tags');
    Route::post('/tags/{id}', 'TagController@update');

    Route::resource('files', 'FileController')->middleware('can:read_arquivos');
    Route::post('/files/{id}', 'FileController@update');
    Route::get('/files/{id}/share', 'FileController@share')->name('files.share');
    Route::post('/files/{id}/share', 'FileController@storeshare')->name('files.storeshare');

    Route::resource('folder', 'FolderController')->middleware('can:read_folders');
    Route::get('folder/categoria/{id}', 'FolderController@showSubcategorias');
    Route::get('folder/subcategoria/{id}', 'FolderController@showFiles');
    Route::get('/folder/{id}/download', 'FolderController@download')->name('folder.download');

    Route::resource('search', 'SearchController')->middleware('can:read_pesquisar');

    Route::resource('share', 'ShareController');

    Route::resource('reports', 'ReportController')->middleware('can:read_relatorios');
    Route::post('/reports/{id}', 'ReportController@update');
    Route::get('/reports/{id}/print', 'ReportController@generatePDF')->name('reports.print');

    Route::resource('logs', 'LogController')->middleware('can:read_logs');

    Route::resource('modules', 'ModuleController')->middleware('can:read_modulos');
    Route::post('/modules/{id}', 'ModuleController@update');

    Route::resource('months', 'MonthController')->middleware('can:read_meses');
    Route::post('/months/{id}', 'MonthController@update');

    Route::resource('years', 'YearController')->middleware('can:read_anos');
    Route::post('/years/{id}', 'YearController@update');
});

Auth::routes();


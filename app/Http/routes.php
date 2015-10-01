<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Rotas de Autenticação

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Rotas de Registro
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Redirecionamento do Login
Route::get('/home', 'PagesController@painel');
Route::get('/', 'PagesController@painel');

////////////////////////////////// Rotas Adicionais

// Licenças

Route::get('licencas/vencidas', [
    'as' => 'licencas.vencidas', 'uses' => 'LicencasController@vencidas'
]);

Route::get('licencas/avencer', [
    'as' => 'licencas.avencer', 'uses' => 'LicencasController@avencer'
]);

// Busca

Route::get('users/busca/{termo}', [
	'as' => 'users.busca', 'uses' => 'UsersController@busca'
]);

Route::get('empresas/busca/{termo}', [
	'as' => 'empresas.busca', 'uses' => 'EmpresasController@busca'
]);

Route::get('licencas/busca/{termo}/{tipo}', [
	'as' => 'licencas.busca', 'uses' => 'LicencasController@busca'
]);

// RESTful Controllers
Route::resource('/users', 'UsersController');
Route::resource('/empresas', 'EmpresasController');
Route::resource('/licencas', 'LicencasController');
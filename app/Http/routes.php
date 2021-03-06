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

//////////////////////////////////////////////////////////////// Rotas de Autenticação

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Rotas de Registro
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Redirecionamento do Login
Route::get('/home', 'PagesController@painel');
Route::get('/', 'PagesController@painel');

//////////////////////////////////////////////////////////////// Rotas Adicionais

// Licenças

Route::get('licencas/vencidas', [
    'as' => 'licencas.vencidas', 'uses' => 'LicencasController@vencidas'
]);

Route::get('licencas/avencer', [
    'as' => 'licencas.avencer', 'uses' => 'LicencasController@avencer'
]);

//////////////////////////////////////////////////////////////// Opções do Usuário

Route::get('/mudarsenha', [
	'as' => 'users.mudarsenha', 'uses' => 'PagesController@mudarSenha'
]);

Route::post('/mudarsenha', [
	'as' => 'users.novasenha', 'uses' => 'PagesController@novaSenha'
]);

Route::get('/alterarfoto', [
	'as' => 'users.alterarfoto', 'uses' => 'PagesController@alterarFoto'
]);

Route::post('/alterarfoto', [
	'as' => 'users.novafoto', 'uses' => 'PagesController@novaFoto'
]);

//////////////////////////////////////////////////////////////// PDFs

Route::get('/imprimir/{id}', [
	'as' => 'licencas.imprimir', 'uses' => 'LicencasController@imprimir'
]);

//////////////////////////////////////////////////////////////// Busca

Route::get('users/busca/{termo}', [
	'as' => 'users.busca', 'uses' => 'UsersController@busca'
]);

Route::get('empresas/busca/{termo}', [
	'as' => 'empresas.busca', 'uses' => 'EmpresasController@busca'
]);

Route::get('licencas/busca/{termo}/{tipo}', [
	'as' => 'licencas.busca', 'uses' => 'LicencasController@busca'
]);

Route::post('busca/', [
	'as' => 'pages.busca', 'uses' => 'PagesController@busca'
]);

Route::get('busca/', function(){
	return redirect('/');
});

Route::post('buscaespecifica', [
	'as' => 'pages.buscaespecifica', 'uses' => 'PagesController@buscaEspecifica'
]);

//////////////////////////////////////////////////////////////// RESTful Controllers
Route::resource('/users', 'UsersController');
Route::resource('/empresas', 'EmpresasController');
Route::resource('/licencas', 'LicencasController');
Route::resource('/tipos', 'TiposController');
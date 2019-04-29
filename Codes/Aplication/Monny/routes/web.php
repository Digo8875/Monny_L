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

//Rotas padrões do Laravel de autenticação, login, recuperação de senha
Auth::routes(['verify' => true]);

//Rota Home, acessível a qualquer pessoa
Route::get('/', 'HomeController@index')->name('home');

//Rotas do sistema só são permitidas à quem está logado e com e-mail confirmado
Route::middleware('auth')->middleware('verified')->group(function () {
    Route::resource('categoria', 'CategoriaController');
	Route::get('categoria/{id}/desativar', 'CategoriaController@desativar');

	Route::resource('sub_categoria', 'Sub_categoriaController');
	Route::get('sub_categoria/{id}/desativar', 'Sub_categoriaController@desativar');

	Route::resource('tipo_dinheiro', 'Tipo_dinheiroController');
	Route::get('tipo_dinheiro/{id}/desativar', 'Tipo_dinheiroController@desativar');

	Route::resource('responsavel', 'ResponsavelController');
	Route::get('responsavel/{id}/desativar', 'ResponsavelController@desativar');

	Route::resource('carteira', 'CarteiraController');
	Route::get('carteira/{id}/desativar', 'CarteiraController@desativar');

	Route::resource('objetivo', 'ObjetivoController');
	Route::get('objetivo/{id}/desativar', 'ObjetivoController@desativar');

	Route::resource('divida', 'DividaController');
	Route::get('divida/{id}/desativar', 'DividaController@desativar');

	Route::resource('registro_financeiro', 'Registro_financeiroController');
	Route::get('registro_financeiro/{id}/desativar', 'Registro_financeiroController@desativar');
});

//->middleware('verified')
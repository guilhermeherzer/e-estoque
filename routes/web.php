<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::middleware('auth')->group(function(){

	Route::get('/home', 							'HomeController@index')->name('home');

	Route::get('/produtos', 						'ProdutosController@index')->name('produtos');
	Route::post('/produtos/cadastrar', 				'ProdutosController@cadastrar')->name('produtos-cadastrar');
	Route::post('/produtos/alterar/{id}', 			'ProdutosController@alterar')->name('produtos-alterar');
	Route::post('/produtos/deletar/{id}', 			'ProdutosController@deletar')->name('produtos-deletar');
	
	Route::get('/tipos-produtos',					'TiposProdutosController@index')->name('tipos-produtos');
	Route::post('/tipos-produtos/cadastrar',		'TiposProdutosController@cadastrar')->name('tipos-produtos-cadastrar');
	Route::post('/tipos-produtos/alterar/{id}',		'TiposProdutosController@alterar')->name('tipos-produtos-alterar');
	Route::post('/tipos-produtos/deletar/{id}',		'TiposProdutosController@deletar')->name('tipos-produtos-deletar');

	Route::get('/marcas-produtos',					'MarcasProdutosController@index')->name('marcas-produtos');
	Route::post('/marcas-produtos/cadastrar',		'MarcasProdutosController@cadastrar')->name('marcas-produtos-cadastrar');
	Route::post('/marcas-produtos/alterar/{id}',	'MarcasProdutosController@alterar')->name('marcas-produtos-alterar');
	Route::post('/marcas-produtos/deletar/{id}',	'MarcasProdutosController@deletar')->name('marcas-produtos-deletar');

	Route::get('/fornecedores', 					'FornecedoresController@index')->name('fornecedores');
	Route::post('/fornecedores/cadastrar', 			'FornecedoresController@cadastrar')->name('fornecedores-cadastrar');
	Route::post('/fornecedores/alterar/{id}', 		'FornecedoresController@alterar')->name('fornecedores-alterar');
	Route::post('/fornecedores/deletar/{id}', 		'FornecedoresController@deletar')->name('fornecedores-deletar');

	Route::get('/entradas', 						'EntradasController@index')->name('entradas');
	Route::post('/entradas/cadastrar', 				'EntradasController@cadastrar')->name('entradas-cadastrar');
	Route::post('/entradas/alterar/{id}', 			'EntradasController@alterar')->name('entradas-alterar');
	Route::post('/entradas/deletar/{id}', 			'EntradasController@deletar')->name('entradas-deletar');

	Route::get('/saidas', 							'SaidasController@index')->name('saidas');
	Route::post('/saidas/cadastrar', 				'SaidasController@cadastrar')->name('saidas-cadastrar');
	Route::post('/saidas/alterar/{id}', 			'SaidasController@alterar')->name('saidas-alterar');
	Route::post('/saidas/deletar/{id}', 			'SaidasController@deletar')->name('saidas-deletar');
	
	Route::get('/estoque',	 						'EstoqueController@index')->name('estoque');
});
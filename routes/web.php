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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 					'HomeController@index')->name('home');
Route::get('/produtos', 				'ProdutosController@index')->name('produtos');
Route::post('/produtos/cadastrar', 		'ProdutosController@cadastrar')->name('produtos-cadastrar');
Route::post('/produtos/alterar/{id}', 	'ProdutosController@alterar')->name('produtos-alterar');
Route::post('/produtos/deletar/{id}', 	'ProdutosController@deletar')->name('produtos-deletar');

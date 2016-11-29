<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');
Route::get('/contatos', 'ContatosController@show')->name('contatos')->middleware('auth');
Route::post('/contatos', 'ContatosController@search')->middleware('auth');
Route::get('/contatos/novo', 'ContatosController@showNovo')->middleware('auth');
Route::post('/contatos/novo/{id}', 'ContatosController@update')->middleware('auth');
Route::post('/contatos/novo', 'ContatosController@novo')->middleware('auth');
Route::get('/contatos/{id}', 'ContatosController@showId')->middleware('auth');
Route::get('/contatos/{id}/telefones', 'ContatosController@telefones')->middleware('auth');
Route::post('/contatos/{id}/telefones', 'ContatosController@telefones_new')->middleware('auth');
Route::get('/contatos/{id}/telefones/{id_tel}', 'ContatosController@telefones_get')->middleware('auth');
Route::post('/contatos/{id}/telefones/{id_tel}', 'ContatosController@telefones_post')->middleware('auth');
Route::get('/contatos/{id}/telefones/{id_tel}/delete', 'ContatosController@telefones_delete')->middleware('auth');

Route::get('/contatos/{id}/relacoes', 'ContatosController@relacoes')->middleware('auth');
Route::get('/contatos/{id}/relacoes/novo', 'ContatosController@relacoes_novo')->middleware('auth');
Route::post('/contatos/{id}/relacoes/novo/busca', 'ContatosController@relacoes_busca')->middleware('auth');
Route::post('/contatos/{id}/relacoes/novo', 'ContatosController@relacoes_post')->middleware('auth');
Route::get('/contatos/{id}/relacoes/{id_relacao}/delete', 'ContatosController@relacoes_delete')->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth')->middleware('admin');
Route::get('/admin/user/{id}', 'AdminController@user_edit')->middleware('auth')->middleware('admin');
Route::post('/admin/user/{id}', 'AdminController@user_modify')->middleware('auth')->middleware('admin');
Route::get('/admin/access/{id}', 'AdminController@access')->middleware('auth')->middleware('admin');
Route::post('/admin/access/{id}', 'AdminController@access_post')->middleware('auth')->middleware('admin');
Route::get('/admin/access/{id}/delete/{id_access}', 'AdminController@access_delete')->middleware('auth')->middleware('admin');

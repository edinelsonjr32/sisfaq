<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
	Route::resource('usuario', 'UserController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::resource('cliente', 'ClienteController');
    Route::get('cliente/{id}/tutorial/create', 'TutorialController@create')->name('cliente.tutorial.create');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('sub_categoria', 'SubCategoriaController');
    Route::resource('tutorial', 'TutorialController');
    Route::post('tutorial/primeiraParte', 'TutorialController@primeiraParte')->name('tutorial.primeira_parte');
    Route::post('tutorial/primeira_Parte/adicionando/sub_categoria', 'TutorialController@primeiraParteSubCategoria')->name('tutorial.primeira_parte.subcategoria');
    Route::post('tutorial/segunda_parte/adicionando/sub_categoria', 'TutorialController@segundaParteSubCategoria')->name('tutorial.segunda_parte.subcategoria');
    Route::get('tutorial/excluir/{id}', 'TutorialController@excluir')->name('tutorial.excluir');
    Route::get('tutorial/editar/dados/{id}', 'TutorialController@edit2')->name('tutorial.editar.dois');
    Route::resource('item_tutorial', 'ItemTutorialController');

});

Route::post('ckeditor/image_upload', 'TutorialController@upload')->name('upload');
Route::get('site/{codigo}/index', 'SiteClienteController@index')->name('site.index');
Route::get('site/{codigo}/categoria/{id}', 'SiteClienteController@categoria')->name('site.categoria');
Route::get('site/{codigo}/sub_categoria/{id}', 'SiteClienteController@subCategoria')->name('site.sub_categoria');
Route::get('site/{codigo}/tutorial/{id}', 'SiteClienteController@tutorial')->name('site.tutorial');

Route::post('/site/{link_acesso}/busca/', 'SiteClienteController@busca')->name('site.busca');


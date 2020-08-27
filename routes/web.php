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
    Route::resource('categoria', 'CategoriaController');
    Route::resource('sub_categoria', 'SubCategoriaController');
    Route::resource('tutorial', 'TutorialController');
    Route::post('tutorial/primeiraParte', 'TutorialController@primeiraParte')->name('tutorial.primeira_parte');
});

Route::get('site/{codigo}/index', 'SiteClienteController@index')->name('site.index');
Route::get('site/{codigo}/categoria/{id}', 'SiteClienteController@categoria')->name('site.categoria');
Route::get('site/{codigo}/sub_categoria/{id}', 'SiteClienteController@subCategoria')->name('site.sub_categoria');


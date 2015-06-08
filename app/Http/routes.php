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

Route::model('category', 'App\Models\Category');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
   Route::get('/categories', ['as' => 'admin.categories.list', 'uses' => 'CategoryController@index']);
   Route::post('/categories/store', ['as' => 'admin.categories.store', 'uses' => 'CategoryController@store']);   
   Route::get('/categories/{category}/edit', ['as' => 'admin.categories.edit', 'uses' => 'CategoryController@edit']);
   Route::post('/categories/{category}/update', ['as' => 'admin.categories.update', 'uses' => 'CategoryController@update']);
   Route::post('/categories/{category}/delete', ['as' => 'admin.categories.delete', 'uses' => 'CategoryController@destroy']);
   Route::get('/categories/{category}/translate/{locale}', ['as' => 'admin.categories.translate', 'uses' => 'CategoryController@translate']);
   Route::post('/categories/{category}/translate/{locale}/store', ['as' => 'admin.categories.translate-store', 'uses' => 'CategoryController@translateStore']);
   Route::post('/categories/sort', [ 'as' => 'admin.categories.sort' ,'uses' => 'CategoryController@sort']);
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

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

Route::model('news', 'App\Models\Category');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
      Route::get('/categories', ['as' => 'admin.categories.list', 'uses' => 'CategoryController@index']);
      Route::get('/categories/create', ['as' => 'admin.categories.create', 'uses' => 'CategoryController@create']);
   // Route::get('/news/{news}/edit', ['as' => 'admin.news.edit', 'uses' => 'Gaia\News\NewsController@edit']);
      Route::post('/categories/store', ['as' => 'admin.categories.store', 'uses' => 'CategoryController@store']);
   // Route::post('/news/{news}/update', ['as' => 'admin.news.update', 'uses' => 'Gaia\News\NewsController@update']);
   // Route::post('/news/{news}/delete', ['as' => 'admin.news.delete', 'uses' => 'Gaia\News\NewsController@destroy']);
   // Route::get('/news/{news}/translate/{locale}', ['as' => 'admin.news.translate', 'uses' => 'Gaia\News\NewsController@translate']);
   // Route::post('/news/{news}/translate/{locale}/store', ['as' => 'admin.news.translate-store', 'uses' => 'Gaia\News\NewsController@translateStore']);
      Route::post('/categories/sort', [ 'as' => 'admin.categories.sort' ,'uses' => 'CategoryController@sort']);
});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

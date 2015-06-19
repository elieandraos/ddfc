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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
   
	//Post Type Routes
   Route::get('/post-types', ['as' => 'admin.post-types.list', 'uses' => 'PostTypeController@index']);
   Route::post('/post-types/store', ['as' => 'admin.post-types.store', 'uses' => 'PostTypeController@store']);   
   Route::get('/post-types/{id}/edit', ['as' => 'admin.post-types.edit', 'uses' => 'PostTypeController@edit']);
   Route::post('/post-types/{id}/update', ['as' => 'admin.post-types.update', 'uses' => 'PostTypeController@update']);
   Route::post('/post-types/{id}/delete', ['as' => 'admin.post-types.delete', 'uses' => 'PostTypeController@destroy']);

   //Post Type
   //Route::get('/post-types/{id}/posts/create', ['as' => 'admin.post-types.list', 'uses' => 'PostController@create']);


});

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

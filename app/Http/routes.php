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


//custom posts
Route::get('/posts/{posttypeslug}/', ['as' => 'posts.list', 'uses' => 'PostController@index']);
//Route::get('/posts/{posttypeslug}/category/{categoryId}', ['as' => 'posts.category.list', 'uses' => 'PostController@category']);


Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

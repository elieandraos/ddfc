<?php

use App\Models\Category;
use App\Models\PostType;
use App\Models\Post;
//use Route;

/*
|--------------------------------------------------------------------------
| POSTS ROUTES
|--------------------------------------------------------------------------
*/
Route::bind('posttypeslug', function($value)
{
    return PostType::where('slug', '=', $value)->first();
});

Route::bind('postslug', function($value)
{
    return Post::where('slug', '=', $value)->first();
});

Route::bind('categorySlug', function($value)
{
    //get the post type from the url param
	/*$routeParamters = Route::current()->parameters();
	$postTypeId = $routeParamters['posttypeid'];
	$this->postType = $this->postTypeRepos->find($postTypeId);*/
	//TO DO: check parent_id (in case category slug exists under different parent)

    return Category::where('slug', '=', $value)->first();
});

Route::get('/posts/{posttypeslug}/', ['as' => 'posts.list', 'uses' => 'PostController@index']);
Route::get('/posts/{posttypeslug}/category/{categorySlug}', ['as' => 'posts.category.list', 'uses' => 'PostController@category']);
Route::get('/posts/{posttypeslug}/{postslug}', ['as' => 'posts.show', 'uses' => 'PostController@show']);


/*
|--------------------------------------------------------------------------
| HOME ROUTES
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
|
*/
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

<?php

use App\Models\Category;
use App\Models\PostType;
use App\Models\Post;
use App\Models\Page;
use App\Models\News;



Route::group(['middleware' => 'auth'], function () {


    /*
    |--------------------------------------------------------------------------
    | Search ROUTES
    |--------------------------------------------------------------------------
    */
    Route::post('/search/', ['as' => 'search.index', 'uses' => 'SearchController@index']);
    Route::post('/newsletter/', ['as' => 'search.newsletter', 'uses' => 'SearchController@newsletter']);

    /*
    |--------------------------------------------------------------------------
    | NEWS ROUTES
    |--------------------------------------------------------------------------
    */
    Route::bind('newsslug', function($value)
    {
        return News::where('slug', '=', $value)->first();
    });

    Route::get('/news/', ['as' => 'news.index', 'uses' => 'NewsController@index']);
    Route::get('/news/{newsslug}/', ['as' => 'news.show', 'uses' => 'NewsController@show']);
    Route::get('/news/category/{id}/', ['as' => 'news.category', 'uses' => 'NewsController@category']);


    /*
    |--------------------------------------------------------------------------
    | PAGES ROUTES
    |--------------------------------------------------------------------------
    */
    Route::bind('pageslug', function($value)
    {
        return Page::where('slug', '=', $value)->first();
    });

    Route::get('/page/{pageslug}/', ['as' => 'pages.show', 'uses' => 'PageController@show']);
    Route::post('/page/contact/', ['as' => 'pages.contact', 'uses' => 'PageController@contact']);

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
    | Admin Subscriber Routs
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
    {
       Route::get('/subscribers', ['as' => 'admin.subscribers.list', 'uses' => 'SubscriberController@index']);
       Route::post('/subscribers/{id}/delete', ['as' => 'admin.subscribers.delete', 'uses' => 'SubscriberController@destroy']);
       Route::get('/subscribers/{id}/show', ['as' => 'admin.subscribers.show', 'uses' => 'SubscriberController@show']);
    });


});




Route::get('/rsvp/', ['as' => 'pages.rsvp', 'uses' => 'PageController@rsvp']);
Route::post('/page/forum-store/', ['as' => 'pages.forum', 'uses' => 'PageController@forum']);


Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//upload route:
Route::post('/upload', [
    'as' => 'media.upload',
    'uses' => 'MediaController@upload',
    'middleware' => 'auth',
]);



<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//repositories
use Gaia\Repositories\PostTypeRepositoryInterface;
use Gaia\Repositories\PostRepositoryInterface;
//Facades
use Route;
use App;

class PostController extends Controller {

	protected $postRepos, $postTypeRepos, $limit;
	
	public function __construct(PostTypeRepositoryInterface $postTypeRepositoryInterface, PostRepositoryInterface $postRepositoryInterface)
	{
		$this->postTypeRepos = $postTypeRepositoryInterface;
		$this->postRepos = $postRepositoryInterface;
		$this->limit = 6;

		//get the post type object from the url param
		$routeParamters = Route::current()->parameters();
		$this->postType = $this->postTypeRepos->getBySlug($routeParamters['posttypeslug']);

		if(!$this->postType)
			App::abort(404, 'Page not found.');
	}


	/**
	 * Displays the listing of the posts
	 * @param type $postTypeSlug 
	 * @return type
	 */
	public function index($postTypeSlug)
	{
		$posts = $this->postRepos->getAllByPostTypeSlug($postTypeSlug, $this->limit);
		return view('front.posts.index', ['posts' => $posts]);
	}


	/**
	 * Displays the listing of the posts filtered by category
	 * @param type $postTypeSlug 
	 * @param type $categoryId 
	 * @return type
	 */
	public function category($postTypeSlug, $categoryId)
	{
		$posts = $this->postRepos->getAllByPostTypeSlug($postTypeSlug, $categoryId, $this->limit);
	}


}

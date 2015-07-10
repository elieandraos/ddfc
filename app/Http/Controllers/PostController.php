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
//Models 
use App\Models\Category;
use App\Models\PostType;
use App\Models\Post;


class PostController extends Controller {

	protected $postRepos, $postTypeRepos, $limit;
	
	public function __construct(PostTypeRepositoryInterface $postTypeRepositoryInterface, PostRepositoryInterface $postRepositoryInterface)
	{
		$this->postTypeRepos = $postTypeRepositoryInterface;
		$this->postRepos = $postRepositoryInterface;
		$this->limit = 6;
	}


	/**
	 * Displays the listing of the posts
	 * @param type $postTypeSlug 
	 * @return type
	 */
	public function index(PostType $postType)
	{
		$posts = $this->postRepos->getAll($postType->id, $this->limit);
		return view('front.posts.index', ['posts' => $posts, 'pageTitle' => $postType->title]);
	}


	/**
	 * Displays the listing of the posts filtered by category
	 * @param type $postTypeSlug 
	 * @param type $categoryId 
	 * @return type
	 */
	public function category(PostType $postType, Category $category)
	{
		$posts = $this->postRepos->getAllByPostTypeIdAndCategoryId($postType->id, $category->id, $this->limit);
		return view('front.posts.index', ['posts' => $posts, 'pageTitle' => $category->title, 'pageDescription' => $category->description]);
	}


	/**
	 * Displays the single post
	 * @param type PostType $postType 
	 * @param type Post $post 
	 * @return type
	 */
	public function show(PostType $postType, Post $post)
	{
		$related_posts = $this->postRepos->getAllRelated($post);
		return view('front.posts.show', ['post' => $post, 'related_posts' => $related_posts]);
	}


}

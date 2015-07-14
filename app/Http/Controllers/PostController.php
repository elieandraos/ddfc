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
use File;
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
		$this->viewsPath = realpath(base_path('resources/views/front/posts/'));
	}


	/**
	 * Displays the listing of the posts
	 * @param type $postTypeSlug 
	 * @return type
	 */
	public function index(PostType $postType)
	{
		$posts = $this->postRepos->getAll($postType->id, $this->limit);
		//get the view name
		if( File::exists($this->viewsPath."/index-".$postType->slug.".blade.php" ))
			$viewName = "front.posts.index-".$postType->slug;
		else
			$viewName = "front.posts.index";
		return view($viewName, ['posts' => $posts, 'pageTitle' => $postType->title]);
	}


	/**
	 * Displays the listing of the posts filtered by category
	 * @param type $postTypeSlug 
	 * @param type $categoryId 
	 * @return type
	 */
	public function category(PostType $postType, Category $category)
	{
		//change limit in case post type is support
		if($postType->slug == 'support')
			$this->limit = 100;

		$posts = $this->postRepos->getAllByPostTypeIdAndCategoryId($postType->id, $category->id, $this->limit);
		
		//get the view name
		if( File::exists($this->viewsPath."/index-".$postType->slug.".blade.php" ))
			$viewName = "front.posts.index-".$postType->slug;
		else
			$viewName = "front.posts.index";

		return view($viewName, ['posts' => $posts, 'pageTitle' => $category->title, 'pageDescription' => $category->description]);
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

        //check if youtube url and id exist in the post:
        $youtubeid = "";
        if($post->youtube_url != "")
        {
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $post->youtube_url, $matches);
            $youtubeid = $matches[1];
        }

		//get the view name
		if( File::exists($this->viewsPath."/show-".$postType->slug.".blade.php" ))
			$viewName = "front.posts.show-".$postType->slug;
		else
			$viewName = "front.posts.show";
		
		return view($viewName, ['post' => $post, 'related_posts' => $related_posts, 'youtube_id'=>$youtubeid]);




	}


}

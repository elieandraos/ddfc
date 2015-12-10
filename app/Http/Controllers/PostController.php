<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//repositories
use Gaia\Repositories\PostTypeRepositoryInterface;
use Gaia\Repositories\PostRepositoryInterface;
use Gaia\Repositories\CategoryRepositoryInterface;
//Facades
use Route;
use App;
use File;
use Lang;
//Models 
use App\Models\Category;
use App\Models\PostType;
use App\Models\Post;
use MetaTag;


class PostController extends Controller {

	protected $postRepos, $postTypeRepos, $limit;
	
	public function __construct(PostTypeRepositoryInterface $postTypeRepositoryInterface, PostRepositoryInterface $postRepositoryInterface, CategoryRepositoryInterface $categoryRepositoryInterface)
	{
		$this->postTypeRepos = $postTypeRepositoryInterface;
		$this->postRepos = $postRepositoryInterface;
		$this->categoryRepos = $categoryRepositoryInterface;
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
		
		if(!isset($postType->id))
		{
			return redirect('/');
		}
		
		 MetaTag::setTitle($postType->title);
         MetaTag::setDescription($postType->description);
         MetaTag::setKeywords($postType->title);
         MetaTag::setFacebookTags([
         	'title' => $postType->title, 
         	'description' => $postType->description, 
         	'image' => "", 
         	'url' => route('posts.list', [$postType->slug]) 
         ]);
        MetaTag::setTwitterDescription($postType->description);

		$categoryId = $postType->getConfiguredRootCategory();
		$category = $this->categoryRepos->find($categoryId);

		if($postType->slug == "entities")
		{
			$posts = ['gov' => [], 'org' => [] ];
			$posts['postsGov'] = $this->postRepos->getAllByPostTypeIdAndCategoryId($postType->id, 30, 50);
			$posts['postsOrg'] = $this->postRepos->getAllByPostTypeIdAndCategoryId($postType->id, 31, 50);
		}
		else
		{
			$posts = $this->postRepos->getOnlyWithContent($postType->id, $this->limit);
		}

		//get the view name
		if( File::exists($this->viewsPath."/index-".$postType->slug.".blade.php" ))
			$viewName = "front.posts.index-".$postType->slug;
		else
			$viewName = "front.posts.index";

		return view($viewName, ['posts' => $posts, 'pageTitle' => $postType->title, 'pageDescription' => $category->description, "postType" => $postType ]);
	}


	/**
	 * Displays the listing of the posts filtered by category
	 * @param type $postTypeSlug 
	 * @param type $categoryId 
	 * @return type
	 */
	public function category(PostType $postType, Category $category)
	{
		
		 MetaTag::setTitle($postType->title." - ".$category->title);
         MetaTag::setDescription($postType->description);
         MetaTag::setKeywords($postType->title);
         MetaTag::setFacebookTags([
         	'title' => $postType->title, 
         	'description' => $postType->description, 
         	'image' => "", 
         	'url' => route('posts.list', [$postType->slug]) 
         ]);
        MetaTag::setTwitterDescription($postType->description);


		//change limit in case post type is support
		if($postType->slug == 'support')
			$this->limit = 100;

		$posts = $this->postRepos->getAllByPostTypeIdAndCategoryId($postType->id, $category->id, $this->limit);
		
		//get the view name
		if( File::exists($this->viewsPath."/index-".$postType->slug.".blade.php" ))
			$viewName = "front.posts.index-".$postType->slug;
		else
			$viewName = "front.posts.index";

		return view($viewName, ['posts' => $posts, 'pageTitle' => $category->title, 'pageDescription' => $category->description, 'category' => $category]);
	}


	/**
	 * Displays the single post
	 * @param type PostType $postType 
	 * @param type Post $post 
	 * @return type
	 */
	public function show(PostType $postType, Post $post)
	{
		
		 MetaTag::setTitle($post->seo->meta_title);
         MetaTag::setDescription($post->seo->meta_description);
         MetaTag::setKeywords($post->seo->meta_keywords);
         MetaTag::setFacebookTags([
         	'title' => $post->seo->facebook_title, 
         	'description' => $post->seo->facebook_description, 
         	'image' => url($post->getFirstMediaURL( $post->getMediaCollectionName(), 'facebook')) , 
         	'url' => route('posts.show', [$postType->slug, $post->slug]) 
         ]);
        MetaTag::setTwitterDescription($post->seo->twitter_description);


		$related_posts = $this->postRepos->getAllRelated($post);

        //check if youtube url and id exist in the post:
        $youtubeid = "";
        if($post->youtube_url != "")
        {
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $post->youtube_url, $matches);
            $youtubeid = $matches[1];
        }

        //check the lang availability
        if(Lang::getLocale() =="ar" && !$post->is_ar)
        	return  view('front.notavailable_ar');

		//get the view name
		if( File::exists($this->viewsPath."/show-".$postType->slug.".blade.php" ))
			$viewName = "front.posts.show-".$postType->slug;
		else
			$viewName = "front.posts.show";
		
		return view($viewName, ['post' => $post, 'related_posts' => $related_posts, 'youtube_id'=>$youtubeid]);




	}


}

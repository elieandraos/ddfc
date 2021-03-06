<?php namespace Gaia\Repositories; 

use App\Models\Post;
use Gaia\Repositories\PostTypeRepositoryInterface;
use App\Models\Component;
use App\Models\ComponentPost;
use Gaia\Services\ComponentPostService;
use Lang;

class PostRepository extends DbRepository implements PostRepositoryInterface 
{
	
	protected $limit = 15, $postTypeRepos;


	public function __construct(PostTypeRepositoryInterface $postTypeRepos)
	{
		$this->postTypeRepos = $postTypeRepos;
	}


	/**
	 * Returns all the posts sorted by published_at
	 * @return PostCollection
	 */
	public function getAll($postTypeId = null, $limit = null, $restrictLang = false)
	{	
		$posts = Post::latest('published_at');
		
		if(!$limit)
			$limit = $this->limit;

		if($restrictLang)
		{
			if(Lang::getLocale() == "ar")
				$posts = $posts->where('is_ar', '=', true);
			if(Lang::getLocale() == "en")
				$posts = $posts->where('is_en', '=', true);
		}

		if($postTypeId)
			return $posts->where('post_type_id', '=', $postTypeId)->paginate($limit);

		return $posts->paginate($limit);
	}


	public function getOnlyWithContent($postTypeId = null, $limit = null)
	{	
		
		if(Lang::getLocale() == "ar")
			$posts =  Post::latest('published_at')->available()->arabic()->where('post_type_id', '=', $postTypeId)->paginate($limit);
		else
			$posts = Post::latest('published_at')->available()->english()->where('post_type_id', '=', $postTypeId)->paginate($limit);

        return $posts;
	}

	/**
	 * Returns one post by id
	 * @param int $id 
	 * @return Post
	 */
	public function find($id)
	{
		return Post::findOrFail($id);
	}


	/**
	 * Create a post object
	 * @param int PostRequest $request 
	 * @return Post
	 */
	public function create($input)
	{
		if(!isset($input['is_en']))
			$input['is_en'] = 0;
		if(!isset($input['is_ar']))
			$input['is_ar'] = 0;
		if(!isset($input['is_na']))
			$input['is_na'] = 0;

		$post = Post::create($input);
		//save the components values		
		$componentIds = $post->retrieveComponentIds($input);
		$this->attachComponentPosts($componentIds, $post->id, $input);

		return $post;
	}


	/**
	 * Update a post object
	 * @param int $id 
	 * @param type $input 
	 * @return Post
	 */
	public function update($id, $input)
	{
		$post = $this->find($id);

		//save the components values		
		$componentIds = $post->retrieveComponentIds($input);
		$this->attachComponentPosts($componentIds, $id, $input);

		if(Lang::getLocale() == 'en')
		{
			if(!isset($input['is_en']))
				$input['is_en'] = 0;
			if(!isset($input['is_ar']))
				$input['is_ar'] = 0;
			if(!isset($input['is_na']))
				$input['is_na'] = 0;
		}
		return $post->update($input); 
	}


	/**
	 * Delete the post object
	 * @param int $id 
	 * @return 
	 */
	public function delete($id)
	{
		$post = $this->find($id);
		$post->delete();
	}


	/**
	 * Returns all the posts sorted by published_at
	 * @return PostCollection
	 */
	public function getAllByPostTypeSlug($slug, $limit = null, $restrictLang = false)
	{	
		
		if(!$slug) return null;
		if(!$limit) $limit = $this->limit;

		$postType = $this->postTypeRepos->getBySlug($slug);

		return $this->getAll($postType->id, $limit, $restrictLang);
	}


	/**
	 * Returns all the posts sorted by published_at and filtered by category id
	 * @param type $slug 
	 * @param type $categoryId 
	 * @param type $limit 
	 * @return type
	 */
	public function getAllByPostTypeIdAndCategoryId($postTypeId, $categoryId, $limit)
	{
		$posts = Post::latest('published_at')->available();
		
		if(!$limit)
			$limit = $this->limit;

		return $posts->where('post_type_id', '=', $postTypeId)->where('category_id', '=', $categoryId)->paginate($limit);
	}


	/**
	 * Returns the related posts (by category id)
	 * @param type $post 
	 * @param type $limit 
	 * @return type
	 */
	public function getAllRelated($post, $limit = 5)
	{
		if(Lang::getLocale() == "ar")
		{
			return Post::latest('published_at')
						->where('post_type_id', '=', $post->post_type_id)
						->where('category_id', '=', $post->category_id)
						->where('id', '!=', $post->id)
						->where('is_ar', '=', true)
						->take($limit)
						->get();
		}
		
		if(Lang::getLocale() == "en")
		{
			return Post::latest('published_at')
						->where('post_type_id', '=', $post->post_type_id)
						->where('category_id', '=', $post->category_id)
						->where('id', '!=', $post->id)
						->where('is_en', '=', true)
						->take($limit)
						->get();
		}
	}



	/**
	 * Save the ComponentPost objects
	 * @param type $componentIds 
	 * @param type $id post id
	 * @param type $input 
	 * @return type
	 */
	public function attachComponentPosts($componentIds, $id, $input)
	{
		if(is_array($componentIds) && count($componentIds))
		{
			$componentPostService = new ComponentPostService;
			foreach($componentIds as $key => $val)
			{
				$ComponentPost = ComponentPost::firstOrCreate(['component_id' => $key, 'post_id' => $id]);
				$ComponentPost->value = $val['value'];
				$ComponentPost->save();
				//Remove the image first if remove_image checkbox is set
				if(isset($input['remove_image']))
				{
					$cp = ComponentPost::find($input['remove_image']);
					$componentPostService->removeImage($cp);
				}
				//if the componenet is an image, upload it and save it to the media library
				if(is_object($val['value']))
				{	
					$componentPostService->uploadImage($ComponentPost, $val['value']);
					$ComponentPost->value = '';
					$ComponentPost->save();
				}
			}
		}
	}
}
?>
<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page;
use Gaia\Repositories\PostRepositoryInterface;
use Gaia\Repositories\PostTypeRepositoryInterface;

use App\Models\Section;
use App\Models\ComponentPost;
use App\Models\Post;
use MediaLibrary;


class PageController extends Controller {

	
	public function __construct(PostRepositoryInterface $postRepositoryInterface, PostTypeRepositoryInterface $postTypeRepositoryInterface)
	{
		$this->postRepos     = $postRepositoryInterface;
		$this->postTypeRepos = $postTypeRepositoryInterface;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Page $page)
	{
		//get metas 
		$metas = [];
		foreach($page->componentPages as $componentPage)
		{
			$key = $componentPage->component->unique_id;
			if($componentPage->component->component_type_id == 3) //image
			{
				$mediaItems = MediaLibrary::getCollection($componentPage, $componentPage->getMediaCollectionName(), []);
				(count($mediaItems))?$url = $mediaItems[0]->getURL('thumb-large'):$url = null; 
				$metas[$key] = $url;
			}	 
			else
				$metas[$key] = $componentPage->value;
		}

		//get members (special case for higher committee)
		$members = $this->postRepos->getAllByPostTypeSlug('members');
		//get the top member
		$postType = $this->postTypeRepos->getBySlug('members');
		$section = $postType->template->sections->first();
		$component = $section->components()->where('unique_id', '=', 'is_highlighted')->first();
		$cp = ComponentPost::where('component_id', '=', $component->id)->first();
		$top_member = Post::find($cp->post_id); 

		return view('front.pages.'.$page->template->title, ['page' => $page, 'content' => $metas, 'members' => $members, 'top_member' => $top_member ]);
	}

}

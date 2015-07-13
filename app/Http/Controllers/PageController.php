<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page;

use App\Models\Section;
use MediaLibrary;


class PageController extends Controller {

	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Page $page)
	{
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

		return view('front.pages.'.$page->template->title, ['page' => $page, 'content' => $metas ]);
	}

}

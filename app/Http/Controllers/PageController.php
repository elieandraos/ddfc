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
use App\Models\Subscriber;
use MediaLibrary;
use MetaTag;
use Redirect;
use Mail;
use Hash;
use Input;


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
		
		MetaTag::setTitle($page->seo->meta_title);
        MetaTag::setDescription($page->seo->meta_description);
        MetaTag::setKeywords($page->seo->meta_keywords);
        MetaTag::setFacebookTags([
         	'title' => $page->seo->facebook_title, 
         	'description' => $page->seo->facebook_description, 
         	'image' => '', 
         	'url' => route('pages.show', $page->slug) 
         ]);
        MetaTag::setTwitterDescription($page->seo->twitter_description);

		//get metas 
		$metas = [];
		foreach($page->componentPages as $componentPage)
		{
			$key = $componentPage->component->unique_id;
			if($componentPage->component->component_type_id == 3) //image
			{
				$mediaItems = MediaLibrary::getCollection($componentPage, $componentPage->getMediaCollectionName(), []);
				(count($mediaItems))?$url = $mediaItems[0]->getURL():$url = null;
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


	public function contact(Request $request)
	{
		$this->validate($request, [
	        'subject' => 'required',
	        'message' => 'required',
	        'email' => 'required|email'
	    ]);

		$data['email'] = $request->email;
		$data['message'] = $request->message;
		$data['subject'] = $request->subject;
		$data['phone'] = $request->phone;

		Mail::send('emails.contact', ['data' => $data],  function($m) use ($data) {
		    $m->from($data['email'], 'DDFC Contact');
		    $m->to('info@communitydubai.com');
		    $m->subject($data['subject']);
		});

		return redirect('page/contact-us?success=1');
	}


	public function forum(Request $request)
	{
		$this->validate($request, [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'email' => 'required|email|unique:subscribers'
	    ]);

		$data['email'] = $request->email;
		$data['first_name'] = $request->first_name;
		$data['last_name'] = $request->last_name;
		$data['phone'] = $request->phone;
		$data['is_verified'] = 0;
		$data['verification_token'] = uniqid();

		Subscriber::create($data);
		
		$data['ticket_id'] = $data['verification_token'];

		Mail::send('emails.rsvp', ['data' => $data],  function($m) use ($data) {
		    $m->from('info@communitydubai.com', 'Community Dubai');
		    $m->to($data['email']);
		    $m->subject("RSVP auto-reply");
		});
		

		Mail::send('emails.rsvp_admin', ['data' => $data],  function($m) use ($data) {
		    $m->from('info@communitydubai.com', 'Community Dubai');
		    $m->to('info@communitydubai.com');
		    $m->subject("RSVP");
		});

		return redirect('rsvp?success=1');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function rsvp()
	{
		
		$page = Page::where('slug', "=", "rsvp")->first();
		
		MetaTag::setTitle($page->seo->meta_title);
        MetaTag::setDescription($page->seo->meta_description);
        MetaTag::setKeywords($page->seo->meta_keywords);
        MetaTag::setFacebookTags([
         	'title' => $page->seo->facebook_title, 
         	'description' => $page->seo->facebook_description, 
         	'image' => '', 
         	'url' => route('pages.show', $page->slug) 
         ]);
        MetaTag::setTwitterDescription($page->seo->twitter_description);

		//get metas 
		$metas = [];
		foreach($page->componentPages as $componentPage)
		{
			$key = $componentPage->component->unique_id;
			if($componentPage->component->component_type_id == 3) //image
			{
				$mediaItems = MediaLibrary::getCollection($componentPage, $componentPage->getMediaCollectionName(), []);
				(count($mediaItems))?$url = $mediaItems[0]->getURL():$url = null;
				$metas[$key] = $url;
			}	 
			else
				$metas[$key] = $componentPage->value;
		}

	

		return view('front.pages.'.$page->template->title, ['page' => $page, 'content' => $metas]);
	}

}

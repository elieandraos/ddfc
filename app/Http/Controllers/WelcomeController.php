<?php namespace App\Http\Controllers;

use Gaia\Repositories\PostRepositoryInterface;
use Gaia\Repositories\NewsRepositoryInterface;
use Auth;

class WelcomeController extends Controller {


	protected $postRepos, $newsRepos;


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(PostRepositoryInterface $postRepos, NewsRepositoryInterface $newRepos)
	{
		$this->postRepos = $postRepos;
		$this->newsRepos = $newRepos;
		//$this->middleware('auth');
	}


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$voices = $this->postRepos->getAllByPostTypeSlug('voices', 3, true);
		$slides = $this->postRepos->getAllByPostTypeSlug('slides');
		
		$campaigns = $this->postRepos->getAllByPostTypeSlug('campaign',1,true);
		
		if(count($campaigns))
		{
			$campaign = $campaigns[0];
	        $youtubeid = "";
	        if($campaign->youtube_url != "")
	        {
	            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $campaign->youtube_url, $matches);
	            $youtubeid = $matches[1];
	        }
		}
		else
		{
			$campaign = null;
			$youtubeid = null;
		}

		$news = $this->newsRepos->getOnlyWithContent(2);

		//if(Auth::user())
			return view('front.index', ['voices' => $voices, 'news' => $news, 'slides' => $slides, 'campaign' => $campaign, 'youtubeid' => $youtubeid]);
		//else
		//	return view('front.comingsoon');
	}

}

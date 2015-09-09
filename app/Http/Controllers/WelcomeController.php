<?php namespace App\Http\Controllers;

use Gaia\Repositories\PostRepositoryInterface;
use Gaia\Repositories\NewsRepositoryInterface;

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
		$this->middleware('auth');
	}


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$voices = $this->postRepos->getAllByPostTypeSlug('voices', 3);
		$slides = $this->postRepos->getAllByPostTypeSlug('slides');

		$news = $this->newsRepos->getOnlyWithContent(2);

		return view('front.index', ['voices' => $voices, 'news' => $news, 'slides' => $slides]);
	}

}

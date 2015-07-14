<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Gaia\Repositories\NewsRepositoryInterface;
use App\Models\News;

class NewsController extends Controller {

	protected $newsRepos;

	public function __construct(NewsRepositoryInterface $newsRepos)
	{
		$this->newsRepos = $newsRepos;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = $this->newsRepos->getAll(2);
		return view('front.news.index', [ 'news' => $news]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(News $news)
	{
		return view('front.news.show', [ 'news' => $news]);
	}

}

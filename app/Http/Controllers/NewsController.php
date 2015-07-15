<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Gaia\Repositories\NewsRepositoryInterface;
use Gaia\Repositories\CategoryRepositoryInterface;
use App\Models\News;
use Response;
use Request;
use View;

class NewsController extends Controller {

	protected $newsRepos;

	public function __construct(NewsRepositoryInterface $newsRepos, CategoryRepositoryInterface $categoryRepos)
	{
		$this->newsRepos = $newsRepos;
		$this->categoryRepos = $categoryRepos;

		//categories
		$this->categories = [];
		$this->categories['feature'] = $this->categoryRepos->getCategoryBySlug('feature');
		$this->categories['event'] = $this->categoryRepos->getCategoryBySlug('event-coverage');
		$this->categories['editorial'] = $this->categoryRepos->getCategoryBySlug('editorial');
		$this->categories['press'] = $this->categoryRepos->getCategoryBySlug('press-release');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = $this->newsRepos->getAll(5);

		$featured_news = $this->newsRepos->getByIsFeatured(2);

		if (Request::ajax()) {
            return View::make('front.news.ajax_news_list', ['news' => $news])->render();
        }
		return view('front.news.index', [ 'news' => $news, 'categories' => $this->categories, 'featured_news' => $featured_news]);
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


	public function category($id)
	{
		$news = $this->newsRepos->getByCategory($id, 5);

		 if (Request::ajax()) {
            return View::make('front.news.ajax_news_list', ['news' => $news])->render();
        }

		return view('front.news.category', [ 'news' => $news, 'categories' => $this->categories]);

	}

}

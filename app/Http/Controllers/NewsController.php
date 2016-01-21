<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Gaia\Repositories\NewsRepositoryInterface;
use Gaia\Repositories\CategoryRepositoryInterface;
use App\Models\News;
use App\Models\Gallery;
use Response;
use Request;
use View;
use Lang;
use MediaLibrary;

use MetaTag;

class NewsController extends Controller {

	protected $newsRepos;

	public function __construct(NewsRepositoryInterface $newsRepos, CategoryRepositoryInterface $categoryRepos)
	{
		$this->newsRepos = $newsRepos;
		$this->categoryRepos = $categoryRepos;

		//categories
		$this->categories = [];
		$this->categories['feature'] = $this->categoryRepos->getCategoryBySlug('features');
		$this->categories['event'] = $this->categoryRepos->getCategoryBySlug('events');
		$this->categories['editorial'] = $this->categoryRepos->getCategoryBySlug('editorials');
		$this->categories['press'] = $this->categoryRepos->getCategoryBySlug('press-releases');
		$this->categories['other'] = $this->categoryRepos->getCategoryBySlug('other');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = $this->newsRepos->getOnlyWithContent(5);
		
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
		if( (Lang::getLocale() == "ar" && !$news->is_ar) || (Lang::getLocale() == "en" && !$news->is_en) )
			return redirect('/');

		 MetaTag::setTitle($news->seo->meta_title);
         MetaTag::setDescription($news->seo->meta_description);
         MetaTag::setKeywords($news->seo->meta_keywords);
         MetaTag::setFacebookTags([
         	'title' => $news->seo->facebook_title, 
         	'description' => $news->seo->facebook_description, 
         	'image' => url($news->getFirstMediaURL( $news->getMediaCollectionName(), 'facebook')) , 
         	'url' => route('news.show', $news->slug) 
         ]);
        MetaTag::setTwitterDescription($news->seo->twitter_description);
        
        $galleryItems = MediaLibrary::getCollection($news->gallery, 'gallery', []);

		$related_news = $this->newsRepos->getByCategory($news->category_id, 5, [$news->id]);
		return view('front.news.show', [ 'news' => $news, 'related_news' => $related_news, 'galleryItems' => $galleryItems]);
	}


	public function category($id)
	{
		$news = $this->newsRepos->getByCategory($id, 5);
		 if (Request::ajax()) {
            return View::make('front.news.ajax_news_list', ['news' => $news])->render();
        }

		return view('front.news.category', [ 'news' => $news, 'categories' => $this->categories]);

	}


	public function listGalleries()
	{
		$galleries = Gallery::latest()->where('id', '!=', 1)->paginate(15);
		return view('front.news.list_galleries', ['galleries' => $galleries, 'pageTitle' => 'Galleries']);
	}


	public function viewGallery($id)
	{
		$gallery = Gallery::find($id);
		$galleryItems = MediaLibrary::getCollection($gallery, 'gallery', []);

		$related_galleries = Gallery::where('id','!=', $id)->limit(5)->get();
		return view('front.news.view_gallery', ['gallery' => $gallery, 'galleryItems' => $galleryItems, 'related_galleries' => $related_galleries]);
	}
}

<?php namespace Gaia\Repositories; 

use App\Models\News;
use App\Models\NewsTranslation;
use App\Models\Locale;
use Lang;
use DB;

class NewsRepository extends DbRepository implements NewsRepositoryInterface 
{
	
	protected $limit = 15;

	/**
	 * Returns all the news sorted by published_at
	 * @return NewsCollection
	 */
	public function getAll($limit = null)
	{	
		if(!$limit)
			$limit = $this->limit;

		return News::latest('published_at')->paginate($limit);

      	
        return $news;
	}


	public function getOnlyWithContent($limit = null)
	{	
		
		if(Lang::getLocale() == "ar")
			$news =  News::latest('published_at')->arabic()->paginate($limit);
		else
			$news = News::latest('published_at')->english()->paginate($limit);

        return $news;
	}

	
	/**
	 * Returns one news by id
	 * @param int $id 
	 * @return News
	 */
	public function find($id)
	{
		return News::findOrFail($id);
	}


	/**
	 * Create a news object
	 * @param int NewsRequest $request 
	 * @return News
	 */
	public function create($input)
	{
		if(!isset($input['is_en']))
			$input['is_en'] = 0;
		if(!isset($input['is_ar']))
			$input['is_ar'] = 0;
		return News::create($input);
	}

	/**
	 * Update a news object
	 * @param int $id 
	 * @param type $input 
	 * @return News
	 */
	public function update($id, $input)
	{
		$news = $this->find($id);
		
		//when not in translating, dont change values
		if(Lang::getLocale() == 'en')
		{
			if(!isset($input['is_featured']))
				$input['is_featured'] = 0;
			if(!isset($input['is_en']))
				$input['is_en'] = 0;
			if(!isset($input['is_ar']))
				$input['is_ar'] = 0;
		}

		return $news->update($input); 
	}


	/**
	 * Delete the news object
	 * @param int $id 
	 * @return 
	 */
	public function delete($id)
	{
		$news = $this->find($id);
		$news->delete();
	}


	public function getByCategory($category_id, $limit, $except= [])
	{
		if(!$limit)
			$limit = $this->limit;

		$news = News::latest('published_at')->where('category_id', '=', $category_id)->whereNotIn('id', $except);
		if(Lang::getLocale() == "ar")
			return $news->arabic()->paginate($limit);

		if(Lang::getLocale() == "en")
			return $news->english()->paginate($limit);
	}


	public function getByIsFeatured($limit)
	{
		if(!$limit)
			$limit = $this->limit;

		return News::latest('published_at')->where('is_featured', '=', 1)->paginate($limit);

	}



}

?>
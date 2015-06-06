<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


//php namespace Gaia\News;

//use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;

//use Gaia\News\NewsRequest;
use Gaia\Repositories\CategoryRepositoryInterface;
//use Gaia\Services\NewsService;
use App\Models\Category;
use Redirect;
use Auth;
use App;
use Input;


class CategoryController extends Controller {

	
	public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
	{
		$this->categoryRepos = $categoryRepositoryInterface;
		$this->authUser = Auth::user();
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sortUrl = route('admin.categories.sort');	
		$categories = $this->categoryRepos->getRoots();
		return view('admin.categories.index')->withCategories($categories)->withSortUrl($sortUrl);
	}


	/**
	 * Sort the categories
	 * @return type
	 */
	public function sort()
	{
		$input = Input::all();
		$json = $input['json_string'];
		$categories = json_decode($json, true);

		//update tree Roots
		Category::updateTreeRoots($categories);
		//rebuild tree to update descandants and order them
		Category::rebuildTree($categories);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		die('s');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

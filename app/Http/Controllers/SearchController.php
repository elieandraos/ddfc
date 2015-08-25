<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\NewsTranslation;
use App\Models\PostTranslation;
use Input;


class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$query = $input['search'];
		$newsTranslations  = NewsTranslation::search($query, null, true)->with('news')->get();
		$postsTranslations = PostTranslation::search($query, null, true)->with('post')->get();

		return view('front.search.index', ['newsTranslations' => $newsTranslations, 'postsTranslations' => $postsTranslations]);
		
	}

}

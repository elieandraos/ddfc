<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\NewsTranslation;
use App\Models\PostTranslation;
use Input;
use Lang;
use App\Models\Locale;
use Newsletter;


class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$locale = Locale::where('language', '=', Lang::getLocale())->first();
		
		$query = $input['search'];
		$newsTranslations  = NewsTranslation::where('locale_id', '=', $locale->id)->search($query, null, true)->with('news')->get();
		$postsTranslations = PostTranslation::where('locale_id', '=', $locale->id)->search($query, null, true)->with('post')->get();

		return view('front.search.index', ['newsTranslations' => $newsTranslations, 'postsTranslations' => $postsTranslations]);
		
	}


	public function newsletter()
	{
		$input = Input::all();
		$email = $input['newsletter_email'];
		$subscriber = Newsletter::subscribe($email);

		return view('front.search.newsletter');
	}

}

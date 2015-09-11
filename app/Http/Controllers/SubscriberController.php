<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Auth;
use View;
use Gaia\Repositories\PostTypeRepositoryInterface;

class SubscriberController extends Controller {


	protected  $authUser;
	/**
	 * Constructor: inject the news repository class to be used in all methods
	 * @return type
	 */
	public function __construct(PostTypeRepositoryInterface $postTypeRepositoryInterface)
	{
		
		$this->authUser = Auth::user();
		
		//share the post type submenu to the layout
		$this->postTypeRepos = $postTypeRepositoryInterface;
		View::share('postTypesSubmenu', $this->postTypeRepos->renderMenu());
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$subscribers = Subscriber::latest()->paginate(15);
		return view('admin.subscribers.index', ['subscribers' => $subscribers]);
	}


	public function show($id)
	{
		$subscriber = Subscriber::find($id);
		return view('admin.subscribers.show', ['subscriber' => $subscriber]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Subscriber::destroy($id);
	}

}

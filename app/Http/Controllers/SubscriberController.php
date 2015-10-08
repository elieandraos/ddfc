<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Auth;
use View;
use Gaia\Repositories\PostTypeRepositoryInterface;
use Excel;


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

	/**
	 * Export a listing of the subscribers.
	 *
	 * @return Excel
	 */
	public function export()
	{
		$data = array();
		$subscribers = Subscriber::all();
		array_push($data,['Title','Name','Email','Phone','Ticket ID','Subscription Date', 'Job Title', 'Company', 'Other', 'Additional Notes']);

		foreach($subscribers as $subscriber)
		{
			array_push($data,[$subscriber->title,
				$subscriber->first_name." ".$subscriber->last_name,
				$subscriber->email,
				$subscriber->phone,
				$subscriber->verification_token,
				$subscriber->getHumanPublishedAt(),
				$subscriber->job_title,
				$subscriber->company,
				$subscriber->other,
				$subscriber->additional_notes,
			]);

		}

		Excel::create('Subscribers', function($excel)  use($data)  {

			$excel->sheet('List', function($sheet) use($data) {
				$sheet->freezeFirstRow();
				$sheet->setOrientation('landscape');
				$sheet->fromArray($data);


			});

		})->download('xls');
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

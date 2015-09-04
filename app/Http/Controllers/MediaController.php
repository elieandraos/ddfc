<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use Response;


class MediaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function upload()
	{
		$file = Input::file('file');

		if($file) {

			$destinationPath = public_path() . '/media/uploaded/';
			$filename = str_random(16) . "_" . $file->getClientOriginalName();

			$upload_success = Input::file('file')->move($destinationPath, $filename);

			if ($upload_success) {


				return Response::json(['message'=>'success','url'=>'/media/uploaded/'.$filename], 200);
			} else {
				return Response::json('Server Error', 400);
			}
		}
		return Response::json('Server Error', 400);
	}

}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Gallery;
use App\Models\MediaProperty;
use App\Http\Controllers\Controller;
use Gaia\Repositories\PostTypeRepositoryInterface;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use View;
use Flash;
use Input;
use Response;
use Redirect;
use MediaLibrary;

class GalleryController extends Controller {

	/**
	 * Constructor: inject needed dependencies
	 * @return type
	 */
	public function __construct(PostTypeRepositoryInterface $postTypeRepositoryInterface)
	{
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
		$galleries = Gallery::latest()->paginate(15);
		return view('admin.galleries.index', ["galleries" => $galleries]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.galleries.create', ['mediaItems' => null ]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(GalleryRequest $request)
	{
		$input = $request->all();
		$input['type'] = 'news';
		$gallery = Gallery::create($input); 
		foreach($input['dz_file'] as $key => $filename)
		{
			if($filename)
			{
				$media = $gallery->addMedia($filename, 'gallery');
				MediaProperty::create([
					'name' => 'caption',
					'value' => $input['dz_caption'][$key],
					'media_id' => $media->id
				]);
				MediaProperty::create([
					'name' => 'caption_ar',
					'value' => $input['dz_caption_ar'][$key],
					'media_id' => $media->id
				]);
			} 
		}
		Flash::success('Gallery was created successfully.');
		return Redirect::route('admin.galleries.list');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$gallery = Gallery::find($id); 
		$mediaItems = MediaLibrary::getCollection($gallery, 'gallery', []);

		return view('admin.galleries.edit', ['gallery' => $gallery, 'mediaItems' => $mediaItems]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(GalleryRequest $request, $id)
	{
		$gallery = Gallery::find($id); 
		$input = $request->all();
		$gallery->update($input);
		
		foreach($input['dz_caption'] as $key => $caption)
		{
			//case media loaded, just update caption
			if(isset($input['dz_media'][$key]) )
			{
				$mp = MediaProperty::where('media_id', '=', (int)$input['dz_media'][$key] )->where('name', '=', 'caption')->first();
				if($mp)
				{
					$mp->value = $caption;
					$mp->save();
				}

				$mp = MediaProperty::where('media_id', '=', (int)$input['dz_media'][$key] )->where('name', '=', 'caption_ar')->first();
				if($mp)
				{
					$mp->value = $input['dz_caption_ar'][$key];
					$mp->save();
				}

			}
			//case new uploaded
			if(isset($input['dz_file'][$key]))
			{
				$filename = $input['dz_file'][$key];
				if($filename)
				{
					$media = $gallery->addMedia($filename, 'gallery');
					MediaProperty::create([
						'name' => 'caption',
						'value' => $caption,
						'media_id' => $media->id
					]);
					MediaProperty::create([
						'name' => 'caption_ar',
						'value' => $input['dz_caption_ar'][$key],
						'media_id' => $media->id
					]);
				}
			}	
		}

		Flash::success('Gallery was updated successfully.');
		return Redirect::route('admin.galleries.list');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$gallery = Gallery::find($id); 
		$gallery->delete();
	}


	public function upload()
	{
		$file = Input::file('file');

        if($file) {

            $destinationPath = storage_path() . '/temp/';
            $filename = str_random(16) . "_" . $file->getClientOriginalName();

            $upload_success = Input::file('file')->move($destinationPath, $filename);

            if ($upload_success) 
            {
                return Response::json(['message'=>'success','filename'=>$destinationPath.$filename], 200);
            } 
            else 
            {
                return Response::json('Server Error', 400);
            }
        }
        return Response::json('Server Error', 400);
	}

}

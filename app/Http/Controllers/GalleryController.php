<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Gallery;
use App\Models\MediaProperty;
use App\Http\Controllers\Controller;
use Gaia\Repositories\PostTypeRepositoryInterface;
use Gaia\Services\GalleryService;

use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use View;
use Flash;
use Input;
use Response;
use Redirect;
use MediaLibrary;
use Spatie\MediaLibrary\Models\Media;

class GalleryController extends Controller {

	/**
	 * Constructor: inject needed dependencies
	 * @return type
	 */
	public function __construct(PostTypeRepositoryInterface $postTypeRepositoryInterface, GalleryService $galleryService)
	{
		//share the post type submenu to the layout
		$this->postTypeRepos = $postTypeRepositoryInterface;
		$this->galleryService = $galleryService;
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
		return view('admin.galleries.create', ['mediaItems' => null , 'thumbUrl' => null]);
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

		if(!isset($input['is_en']))
			$input['is_en'] = 0;
		if(!isset($input['is_ar']))
			$input['is_ar'] = 0;
		if(!isset($input['is_na']))
			$input['is_na'] = 0;
		
		$gallery = Gallery::create($input); 


		//upload the image via service
		if(isset($input['image']))
			$this->galleryService->uploadImage($gallery, $input['image']);

		foreach($input['dz_file'] as $key => $filename)
		{
			if($filename)
			{
				$media = $gallery->addMedia($filename, 'gallery');
				$media->order = $input['dz_order'][$key];
				$media->save();

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
		$mediaItems = $mediaItems->sortBy('order');

		//get the small preview thumb if image is uploaded
		$featuredItems = MediaLibrary::getCollection($gallery, $gallery->getMediaCollectionName(), []);
		(count($featuredItems))?$thumbUrl = $featuredItems[0]->getURL('thumb'):$thumbUrl = null; 

		return view('admin.galleries.edit', ['gallery' => $gallery, 'mediaItems' => $mediaItems, 'thumbUrl' => $thumbUrl]);
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
		
		if(!isset($input['is_en']))
			$input['is_en'] = 0;
		if(!isset($input['is_ar']))
			$input['is_ar'] = 0;
		if(!isset($input['is_na']))
			$input['is_na'] = 0;

		//reset the input image
		if(isset($input['remove_image']) && !isset($input['image']))
			$input['image'] = null;

		//remove image if checkbox is ticked
		if(isset($input['remove_image']))
			$this->galleryService->removeImage($gallery);

		$gallery->update($input);

		//upload new picture if any 
		if(isset($input['image']))
			$this->galleryService->uploadImage($gallery, $input['image']);

		
		foreach($input['dz_caption'] as $key => $caption)
		{
			//case media loaded, just update caption
			if(isset($input['dz_media'][$key]) )
			{	
				$media = Media::find($input['dz_media'][$key]);
				$media->order = $input['dz_order'][$key];
				$media->save();

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
					$media->order = $input['dz_order'][$key];
					$media->save();
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

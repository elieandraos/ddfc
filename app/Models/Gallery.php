<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaLibraryModel\MediaLibraryModelInterface;
use Spatie\MediaLibrary\MediaLibraryModel\MediaLibraryModelTrait;
use App\Models\MediaProperty;

class Gallery extends Model implements MediaLibraryModelInterface{

	use MediaLibraryModelTrait;

	protected $table = 'galleries';
	protected $fillable = ['name', 'type'];

	public static function getTypes()
	{
		return ['News', 'Knowledge', 'Voices'];
	}

	public function getImageProfileProperties()
	{
	    return [
	    	//large
	        'featured'  => ['w'=>800, 'h'=>600],
	        'thumb'     => ['w'=>60, 'h'=>60],
	        'thumb-back' => ['w'=>150, 'h'=>130]
	    ];
	}   


	public function getMediaCaption($media_id)
	{
		$mp = MediaProperty::where('media_id', '=', $media_id)->where('name', '=', 'caption')->first();
		if($mp)
			return $mp->value;

		return null;
	} 
}

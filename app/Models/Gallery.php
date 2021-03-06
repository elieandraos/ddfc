<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaLibraryModel\MediaLibraryModelInterface;
use Spatie\MediaLibrary\MediaLibraryModel\MediaLibraryModelTrait;
use App\Models\MediaProperty;
use Lang;
use Nicolaslopezj\Searchable\SearchableTrait;

class Gallery extends Model implements MediaLibraryModelInterface{

	use MediaLibraryModelTrait, SearchableTrait;

	protected $table = 'galleries';
	protected $fillable = ['name', 'name_ar', 'type', 'is_en', 'is_ar', 'is_na'];
	protected $searchable = [
        'columns' => [
            'name' => 10,
            'name_ar' => 10
        ],
        'joins' => [
            
        ]
    ];


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
	        'thumb-back' => ['w'=>150, 'h'=>130],
	        'thumb-large'     => ['w'=>570, 'h'=>325],
	        'thumb-medium'    => ['w'=>270, 'h'=>192],
	         'thumb-small'     => ['w'=>170, 'h'=>120]
	    ];
	}   


	public function getMediaCaption($media_id)
	{
		$mp = MediaProperty::where('media_id', '=', $media_id)->where('name', '=', 'caption')->first();
		if($mp)
			return $mp->value;

		return null;
	} 

	public function getMediaProperty($media_id, $name = 'caption')
	{
		$mp = MediaProperty::where('media_id', '=', $media_id)->where('name', '=', $name)->first();
		if($mp)
			return $mp->value;

		return null;
	} 


	/**
     * Return the media collection name
     * @return type
     */
    public function getMediaCollectionName()
    {
    	return "gallery-collection-".$this->id;
    }

    public function getName()
    {
    	if(Lang::getLocale() == "en")
    		return $this->name;

    	if(Lang::getLocale() == "ar")
    		return $this->name_ar;

    }

    /******************
	 *    SCOPES      *
	 ******************/

	public function scopeEnglish($query)
    {
        return $query->where('is_en', '=', 1);
    }


    public function scopeArabic($query)
    {
        return $query->where('is_ar', '=', 1);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_na', '=', 0);
    }

}

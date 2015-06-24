<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class ComponentPage extends Model implements TranslatableContract {

	use Translatable;

	protected $table = 'component_page';
	protected $fillable = ['component_id', 'page_id', 'value', 'params'];
	protected $translatedAttributes = ['value', 'params'];
	protected $translator = 'App\Models\ComponentPageTranslation';
	public $timestamps = false;

	/**
	 * Component Relation
	 * @return type
	 */
	public function component()
	{
		return $this->belongsTo('App\Models\Component');
	}

	/**
	 * Page Relation
	 * @return type
	 */
	public function page()
	{
		return $this->belongsTo('App\Models\Page');
	}


}

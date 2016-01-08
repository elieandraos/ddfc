<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaProperty extends Model {

	protected $table = 'media_properties';
	protected $fillable = ['media_id', 'name', 'value'];

	public function media()
	{
		return $this->belongsTo('Spatie\MediaLibrary\Models\Media');
	}

}

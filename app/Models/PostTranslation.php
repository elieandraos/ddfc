<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PostTranslation extends Model {

	use SearchableTrait;

	protected $searchable = [
        'columns' => [
            'title' => 10,
            'description' => 2,
            'excerpt'	=> 10
        ],
        'joins' => [
            'post' => ['post.id','post_translations.post_id'],
        ]
    ];


    public function post()
	{
		return $this->belongsTo('App\Models\Post');
	}


}

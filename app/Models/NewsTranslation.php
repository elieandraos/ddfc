<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class NewsTranslation extends Model {

	use SearchableTrait;

	protected $searchable = [
        'columns' => [
            'title' => 10,
            'description' => 5,
            'excerpt'	=> 2
        ],
        'joins' => [
            'news' => ['news.id','news_translations.news_id'],
        ]
    ];


    public function news()
	{
		return $this->belongsTo('App\Models\News');
	}


}

?>
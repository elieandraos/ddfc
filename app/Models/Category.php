<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Node;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class Category extends Node implements TranslatableContract {

	use Translatable;

	protected $table = 'categories';
	protected $fillable = ['title'];
	protected $translatedAttributes = ['title'];
	protected $translator = 'App\Models\CategoryTranslation';


	/***************
	 * NESTED SETS *
	 ***************/
	public function renderNode($category) 
	{
	  $data = [];
	  $data['category']    = $category;
	  $data['id']    = $category->id;
	  $data['title']  = $category->title;
	 
	  // $data['url']   = route('application.{application}.news.index', [$category->application->slug, 'category' => $category->id]);
	  //$data['title'] = "This category has {$count} news.";
	 
	  echo "<li class='dd-item dd3-item' data-id='{$category->id}'>";
	  echo "<div class='dd-handle'><i class='fa fa-bars'></i></div>";
	  echo "<div class='dd3-content'>".view('admin.categories._list_row')->withData($data)->render()."</div>";
	  
	  if ( $category->hasChildren() ) {
	    echo "<ul class='dd-list'>";
	    	foreach($category->children as $child) $this->renderNode($child);
	    echo "</ul>";
	  }
	  echo "</li>";
	}


	/**
	 * Updates the nodes order
	 * @param type $categories 
	 * @return type
	 */
	public static function build($categories)
	{
		if(is_array($categories))
		{
			foreach($categories as $cat)
			{
				$parent = Category::find($cat['id']);
				if(is_array($cat['children']))
				{
					foreach($cat['children'] as $child)
					{
						$descendant = Category::find($child['id']);
						$descendant->parent_id = $parent->id;
						$descendant->save();
					}
				}
			}
		}
	}


}

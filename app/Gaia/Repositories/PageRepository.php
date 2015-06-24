<?php namespace Gaia\Repositories; 

use App\Models\Page;
use App\Models\Component;
use App\Models\ComponentPage;


class PageRepository extends DbRepository implements PageRepositoryInterface 
{
	
	protected $pageService;
	/**
	 * Returns all the Pages
	 * @return PagesCollection
	 */
	public function getAll()
	{	
		return Page::orderBy('created_at')->get();
	}


	/**
	 * Find Page by Id
	 * @param type $id 
	 * @return type
	 */
	public function find($id)
	{
		return Page::findOrFail($id);
	}


	/**
	 * Create a page
	 * @param type $input 
	 * @return type
	 */
	public function create($input)
	{
		return Page::create($input);
	}


	/**
	 * Delete the page
	 * @param int $id 
	 * @return 
	 */
	public function delete($id)
	{
		$page = $this->find($id);
		$page->delete();
	}


	/**
	 * Update a page object
	 * @param int $id 
	 * @param type $input 
	 * @return News
	 */
	public function update($id, $input)
	{
		$page = $this->find($id);
		//Remove images first if remove_image checkbox is set
		if(isset($input['remove_image']))
		{
			
		}
		//save the components values		
		$componentIds = $page->retrieveComponentIds($input);
		$this->attachComponentPages($componentIds, $id);
		//save the page
		$page->update($input); 
		return $page;
	}


	/**
	 * Save the ComponentPage objects
	 * @param type $componentIds 
	 * @param type $id page_id
	 * @return type
	 */
	public function attachComponentPages($componentIds, $id)
	{
		if(is_array($componentIds) && count($componentIds))
		{
			foreach($componentIds as $key => $val)
			{
				$componentPage = ComponentPage::firstOrCreate(['component_id' => $key, 'page_id' => $id]);
				$componentPage->value = $val['value'];
				$componentPage->save();
			}
		}
	}

}

?>
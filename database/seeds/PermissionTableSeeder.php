<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder {

	/**
	 * Description
	 * @return type
	 */
	public function run()
	{		
		$this->cleanUp();

		/** News **/
		Permission::create([
			"name" => "create-edit-news",
			"display_name" => "Create/edit a news",
			"description" => "Ability to create and edit news posts."
		]);

		Permission::create([
			"name" => "delete-news",
			"display_name" => "Remove a news",
			"description" => "Ability to delete a news post."
		]);

		Permission::create([
			"name" => "list-news",
			"display_name" => "View all news",
			"description" => "Ability to view all news."
		]);

		Permission::create([
			"name" => "translate-news",
			"display_name" => "Translate news",
			"description" => "Ability to translate news to other languages."
		]);

		/** Page Templates **/
		Permission::create([
			"name" => "create-edit-page-templates",
			"display_name" => "Create/edit a page template",
			"description" => "Ability to create and edit page templates."
		]);

		Permission::create([
			"name" => "delete-page-templates",
			"display_name" => "Remove a page template",
			"description" => "Ability to delete a page template."
		]);

		Permission::create([
			"name" => "list-page-templates",
			"display_name" => "View all page templates",
			"description" => "Ability to view all page templates."
		]);

		/** Pages **/
		Permission::create([
			"name" => "create-edit-pages",
			"display_name" => "Create/edit a page",
			"description" => "Ability to create and edit page."
		]);

		Permission::create([
			"name" => "delete-pages",
			"display_name" => "Remove a page",
			"description" => "Ability to delete a page."
		]);

		Permission::create([
			"name" => "list-pages",
			"display_name" => "View all pages",
			"description" => "Ability to view all pages."
		]);	

		Permission::create([
			"name" => "translate-pages",
			"display_name" => "Translate pages",
			"description" => "Ability to translate pages to other languages."
		]);			

		/** Categories **/
		Permission::create([
			"name" => "manage-categories",
			"display_name" => "Manage categories",
			"description" => "Ability to add/edit/delete/translate categories."
		]);	
	}


	/**
	 * truncates the table before seeding
	 * @return type
	 */
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('permissions')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
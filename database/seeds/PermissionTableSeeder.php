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
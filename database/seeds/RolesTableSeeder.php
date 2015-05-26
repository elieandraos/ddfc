<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;

class RolesTableSeeder extends Seeder {

	/**
	 * Description
	 * @return type
	 */
	public function run()
	{		
		$this->cleanUp();

		$user = User::find(1);
		$role = Role::create(['display_name' => 'Superadmin', 'name' => 'superadmin']);
		$user->attachRole($role);
	}

	/**
	 * truncates the table before seeding
	 * @return type
	 */
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('roles')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
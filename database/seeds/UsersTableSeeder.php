<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

	/**
	 * Description
	 * @return type
	 */
	public function run()
	{		
		$this->cleanUp();

		User::create([
			"email" => "gaia@mcsaatchi.me",
			"name" => "Gaia Admin",
			"password" => Hash::make("123456")
		]);
	}

	/**
	 * truncates the table before seeding
	 * @return type
	 */
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
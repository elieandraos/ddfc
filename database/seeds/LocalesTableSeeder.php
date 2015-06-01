<?php

use Illuminate\Database\Seeder;
use App\Models\Locale;

class LocalesTableSeeder extends Seeder {

	/**
	 * Description
	 * @return type
	 */
	public function run()
	{		
		$this->cleanUp();

		Locale::create(["language" => "en"]);
		Locale::create(["language" => "ar"]);
		Locale::create(["language" => "fr"]);
	}

	/**
	 * truncates the table before seeding
	 * @return type
	 */
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		DB::table('locales')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
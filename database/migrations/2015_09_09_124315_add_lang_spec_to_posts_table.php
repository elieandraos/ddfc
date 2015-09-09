<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangSpecToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post', function(Blueprint $table)
		{
			$table->boolean('is_en')->default(1);
			$table->boolean('is_ar')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post', function(Blueprint $table)
		{
			$table->dropColumn('is_en');
			$table->dropColumn('is_ar');
		});
	}

}

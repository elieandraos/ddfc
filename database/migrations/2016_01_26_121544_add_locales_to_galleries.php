<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocalesToGalleries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('galleries', function(Blueprint $table)
		{
			$table->boolean('is_na')->defaults(0);
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
		Schema::table('galleries', function(Blueprint $table)
		{
			$table->dropColumn('is_na');
			$table->dropColumn('is_en');
			$table->dropColumn('is_ar');
		});
	}

}

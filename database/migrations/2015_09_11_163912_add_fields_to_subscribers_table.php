<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscribers', function(Blueprint $table)
		{
			$table->string('title');
			$table->text('address');
			$table->string('job_title');
			$table->string('company');
			$table->string('field');
			//$table->integer('country_id');
			$table->boolean('is_sign');
			$table->boolean('is_braille');
			$table->boolean('is_large');
			$table->boolean('is_electronic');
			$table->boolean('other');
			$table->text('additional_notes');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subscribers', function(Blueprint $table)
		{
			$table->dropColumn('title');
			$table->dropColumn('address');
			$table->dropColumn('job_title');
			$table->dropColumn('company');
			$table->dropColumn('field');
			//$table->integer('country_id');
			$table->dropColumn('is_sign');
			$table->dropColumn('is_braille');
			$table->dropColumn('is_large');
			$table->dropColumn('is_electronic');
			$table->dropColumn('other');
			$table->dropColumn('other');
		});
	}

}

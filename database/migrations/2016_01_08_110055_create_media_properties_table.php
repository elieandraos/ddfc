<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media_properties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('value');

			$table->integer('media_id')->unsigned();
			$table->foreign('media_id')
						->references('id')
						->on('media')
						->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('media_properties');
	}

}

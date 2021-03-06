<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelToLinkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	# Create pivot table connecting `user` and `channel`
	public function up() 
	{
		Schema::create('channel_link', function($table) {
			# AI, PK
			# none needed
			# General data...
			$table->increments('id');
			$table->integer('channel_id')->unsigned();
			$table->integer('link_id')->unsigned();
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('channel_link');
	}

}

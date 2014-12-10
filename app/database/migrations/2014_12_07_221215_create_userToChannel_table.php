<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserToChannelTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	# Create pivot table connecting `user` and `channel`
	public function up() 
	{
		Schema::create('user_channel', function($table) {
			# AI, PK
			# none needed
			# General data...
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('channel_id')->unsigned();
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_channel');
	}
}

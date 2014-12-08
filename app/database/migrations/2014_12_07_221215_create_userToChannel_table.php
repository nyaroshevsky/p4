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
		Schema::create('user_chanel', function($table) {
			# AI, PK
			# none needed
			# General data...
			$table->integer('user_id')->unsigned();
			$table->integer('channel_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('channel_id')->references('id')->on('channels');
			
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_chanel');
	}
}

<?php

class Add_Image_To_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("users", function($table){
			$table->string("image",32);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$Schema::table("users", function ($table){
			$table->drop_column("image");
		});
	}

}
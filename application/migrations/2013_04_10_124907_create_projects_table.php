<?php

class Create_Projects_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("projects",function($table){
			$table->increments("id");
			$table->string("name", 128);
			$table->string("title", 128);
			$table->string("description", 128);
			$table->integer("user_id");
			$table->integer("created_by");
			$table->integer("updated_by");
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("projects");
	}


}
<?php

class Create_Project_Groups_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("project_groups",function($table){
			$table->increments("id");
			$table->string("name", 50);
			$table->string("description", 128);
			$table->integer("project_id");
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
		Schema::drop("project_groups");
	}

}
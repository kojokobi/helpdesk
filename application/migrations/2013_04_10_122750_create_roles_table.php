<?php

class Create_Roles_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("roles", function ($table){
			$table->increments("id");
			$table->string("name");
			$table->string("description");
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
		Schema::drop("roles");
	}

}
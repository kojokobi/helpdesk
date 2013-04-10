<?php

class Create_Ticket_Types_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("ticket_types", function ($table){
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
		Schema::drop("ticket_types");
	}

}
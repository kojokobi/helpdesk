<?php

class Tickets_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("tickets", function ($table){
			$table->increments("id");
			$table->string("title");
			$table->string("number", 50);
			$table->integer('ticket_status_id');
			$table->integer('priority_id');
			$table->integer('project_id');
			$table->integer('assigned_to');
			$table->integer('ticket_type_id');
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
		Schema::drop("tickets");
	}

}	
<?php

class Ticket_Details_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("ticket_details", function ($table){
			$table->increments("id");
			$table->integer("ticket_id");
			$table->text("message");
			$table->integer("ticket_status_id");
			$table->boolean("is_active");
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
		Schema::drop("ticket_details");
	}

}
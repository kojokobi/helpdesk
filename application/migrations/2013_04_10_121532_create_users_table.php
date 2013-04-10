<?php

class Create_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("users", function ($table){
			$table->increments("id");
			$table->string("first_name", 128);
			$table->string("last_name", 128);
			$table->string("user_name",128);
			$table->string("other_names",128);
			$table->string("email");
			$table->string("phone");
			$table->string("image", 32);
			$table->string("password");
			$table->integer("job_title_id");
			$table->integer("role_id");
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
		Schema::drop("users");
	}

}
<?php

class Create_Securable_Permissions_Table {

	/**
	 *this function will create the permissions table
	 * and the specified columns.
	 * @return void
	 */
	public function up()
	{
		// create the permissions table
		Schema::create('permissions', function($table) {
			// $table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->integer("module_id");
		    $table->integer('securable_id')->unsigned();		    
		    $table->integer('role_id')->unsigned();
		    $table->text('privileges');    
		    $table->integer('created_by')->unsigned();
		    $table->integer('updated_by')->unsigned();
		    $table->timestamps();		    
		});	

	}

	/**
	 * this function will drop the permissions table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permissions');
	}
}
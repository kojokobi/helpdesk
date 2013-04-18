<?php

class Create_Module_Permissions_Table {

	/**
	 *this function will create the module_permissions table
	 * and the specified columns.
	 * @return void
	 */
	public function up()
	{
		// create the module_permissions table
		Schema::create('module_permissions', function($table) {
			//$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->integer('module_id')->unsigned();
		    $table->integer('role_id')->unsigned();
		    $table->text('privileges'); 
		    $table->integer('created_by')->unsigned();
		    $table->integer('updated_by')->unsigned();
		    $table->timestamps();		    
		});

	}

	/**
	 * this function will drop the module_permissions table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module_permissions');
	}

}
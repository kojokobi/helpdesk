<?php

class Create_Modules_Table {

	/**
	 *this function will create the modules table
	 * and the specified columns.
	 * @return void
	 */
	public function up()
	{
		// create the modules table
		Schema::create('modules', function($table) {
			//$table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->string('name', 128);
		    $table->string('display_name', 50);		    
		    $table->integer('list_order')->default(1);
		    $table->integer('created_by')->unsigned();
		    $table->integer('updated_by')->unsigned();
		    $table->timestamps();		    
		});	

		
	}

	/**
	 * this function will drop the modules table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('modules');
	}


}
<?php

return array(

			/*
			|--------------------------------------------------------------------------
			| Flag to determine the type of messages to display.
			|--------------------------------------------------------------------------
			|By default the application assumes  it is in a development 
			|environment  so technical or exception messages are displayed on the client side.The application 
			|will display a user friendly message if environment = 'production' is set.
			|
			*/
			'environment' => 'development',
			/*
			|--------------------------------------------------------------------------
			| Generic friendly message to send to the client side when an error ocurrs
			|--------------------------------------------------------------------------
			|Generic Error message to display to a user when an error occures in a production 
			|environment.Techinical messages will always be displayed when app is in 
			|development mode.
			*/
			'global_error_message' => 'an error occurred.contact your admin',
			/*
			|--------------------------------------------------------------------------
			| Default Ticket_Status Id
			|--------------------------------------------------------------------------
			|Default ticket_status_id as auto-generated in the db table ticket_statuses
			|
			|
			*/
			'default_ticket_status'=>1,
			/*
			|--------------------------------------------------------------------------
			| Closed ticket_status Id
			|--------------------------------------------------------------------------
			|The id of a closed ticket_status in the ticket_statuses table
			|
			|
			*/
			'closed_ticket_status_id'=>2,
			/*
			|--------------------------------------------------------------------------
			| Resolved ticket_status Id
			|--------------------------------------------------------------------------
			|The id of a resolved ticket in the ticket_statuses table
			|
			|
			*/
			'resolved_ticket_status_id'=>3,
			/*
			|--------------------------------------------------------------------------
			| UnResolved ticket_status Id
			|--------------------------------------------------------------------------
			|The id of an unresolved ticket in the ticket_statuses table
			|
			|
			*/
			'unresolved_ticket_status_id'=>4,
		);

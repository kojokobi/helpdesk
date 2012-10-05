<?php

class Summary_Controller extends Base_Controller{

	public $restful = true;

	public function get_counts(){

		return Response::json(Summary::get_counts());
	}
	public function get_incoming_tickets(){

		return Response::json(Summary::get_incoming_tickets());
	}
	public function get_outgoing_tickets(){
		return Response::json(Summary::get_outgoing_tickets());
	}


}
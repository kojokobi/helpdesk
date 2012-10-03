<?php

class Summary_Controller extends Base_Controller{

	public $restful = true;

	public function get_counts(){

		return Response::json(Summary::get_counts());
	}
	


}
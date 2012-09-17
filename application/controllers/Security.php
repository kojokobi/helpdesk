<?php

class Security_Controller extends Base_Controller{

	public $restful = true;

	/*
	*login method.
	*
	*/
	public function post_login(){

		$credentials = Input::all();
		$security = new Security();
		$isAuth = $security->login($credentials);

		if($isAuth)
			return Redirect::to("admin");
		else
			return Redirect::to('login')->with('login_errors',true);
		
	}

	public function post_logout(){
		
	}
	public function post_user(){
	
		$userData = array(

				'firstName' 	=> Input::get('firstName'),
				'lastName' 		=> Input::get('lastName'),
				'userName' 		=> Input::get('userName'),
				'otherNames'	=> Input::get('otherNames'),
				'email'			=> Input::get('email'),
				'phone'			=> Input::get('phone'),
				'password'		=> Input::get('password'),
				'jobTitleId'	=> Input::get('jobTitleId'),
				'roleId'		=> Input::get('roleId'),
				'createdBy'		=> Auth::user()->id,
				'lastUpdateBy'	=> Auth::user()->id
				
			);	
		return Response::json(User::create_user($userData));
	}
		
	public function put_user(){

		$userData = array(

				'id'			=> Input::get('id'),
				'firstName' 	=> Input::get('firstName'),
				'lastName' 		=> Input::get('lastName'),
				'userName' 		=> Input::get('username'),
				'otherNames'	=> Input::get('otherNames'),
				'email'			=> Input::get('email'),
				'phone'			=> Input::get('phone'),
				'password'		=> Input::get('password'),
				'jobTitleId'	=> Input::get('jobTitleId'),
				'roleId'		=> Input::get('roleId'),
				'createdBy'		=> Auth::user()->id,
				'lastUpdateBy'	=> Auth::user()->id
				
			);	
		return Response::json(User::update_user($userData));
	}
	public function get_users(){

		return Response::json(User::get_users(Input::all()));
	}
	
}
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

	public function get_logout(){
		Auth::logout();
		return Redirect::to("login");
	}
	public function post_user(){

		$client_data = Input::json();
		return Response::json(User::create_user($client_data));
	
		// $userData = array(

		// 		'firstName' 	=> Input::get('firstName'),
		// 		'lastName' 		=> Input::get('lastName'),
		// 		'userName' 		=> Input::get('userName'),
		// 		'otherNames'	=> Input::get('otherNames'),
		// 		'email'			=> Input::get('email'),
		// 		'phone'			=> Input::get('phone'),
		// 		'password'		=> Input::get('password'),
		// 		'jobTitleId'	=> Input::get('jobTitleId'),
		// 		'roleId'		=> Input::get('roleId'),
		// 		'createdBy'		=> Auth::user()->id,
		// 		'lastUpdateBy'	=> Auth::user()->id
				
		// 	);	
		// return Response::json(User::create_user($userData));
	}
	public function put_user(){

		$client_data = Input::json();
		return Response::json(User::update_user($client_data));
	}
	public function get_users(){
		//var_dump(Auth::user());
		return Response::json(User::get_users(Input::all()));
	}
	
}
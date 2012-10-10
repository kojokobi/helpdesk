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
			return Redirect::to("dashboard_view");
		else
			return Redirect::to('login')->with('login_errors',true);
	}
	public function get_login(){

		return View::make('login.index');
	}

	public function get_logout(){
		Auth::logout();
		return Redirect::to("login");
	}
	public function post_user(){

		$client_data = Input::json();
		return Response::json(User::create_user($client_data));
	}

	public function put_user(){
		$client_data = Input::json();
		return Response::json(User::update_user($client_data));
	}
	public function get_users(){
		//var_dump(Auth::user());
		return Response::json(User::get_users(Input::all()));
	}
	public function post_change_password(){

		return Reponse::json(User::change_password(Input::json()));
	}
	public function post_update_user_profile(){

		return Response::json(User::update_user_profile(input::json()));
	}
	
}
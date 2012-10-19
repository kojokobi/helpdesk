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

		return Response::json(User::change_password(Input::json()));
	}
	public function post_update_user_profile(){

		return Response::json(User::update_user_profile(Input::json()));
	}
	//modules
	public function post_create_module(){
		return  Response::json(Module::create_module(Input::json()));
	}
	public function get_modules(){
	
		return 	Response::json(Module::get_modules(Input::all()));

	}
	public function put_update_module(){
		return Response::json(Module::update_module(Input::json()));
	}
	public function delete_module(){
		return Response::json(Module::delete_module(Input::json()));
	}
	//securables
	public function post_create_securable(){
		return Response::json(Securable::create_securable(Input::json()));
	}
	public function get_securables(){
		return Response::json(Securable::get_securables(Input::all()));
	}
	public function put_update_securable(){
		return Response::json(Securable::update_securable(Input::json()));
	}
	public function delete_securable(){
		return Response::json(Securable::delete_securable(Input::all()));
	}
	//permissions
	public function post_create_permission(){
		return Response::json(permission::create_permission(Input::json()));
	}
	public function get_permissions(){
		return Response::json(permission::get_permissions());
	}
	public function put_update_permission(){
		return Response::json(permission::update_permission(Input::json()));
	}
	public function delete_permission(){
		return Response::json(permission::delete_permission(Input::json()));
	}
	public function get_securables_array(){

		return Response::json(Securable::get_securables_array());
	}
	public function get_modules_array(){

		return Response::json(Module::get_modules_array());
	}
	public function get_module_permissions(){

		return Response::json(ModulePermission::get_module_permissions(Input::all()));
	}
	public function post_module_permission(){
		return Response::json(ModulePermission::create_module_permission(Input::json()));
	}

	
}
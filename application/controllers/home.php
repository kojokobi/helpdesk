<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/
	
	public $restful	 = true;
	public function action_index()
	{
		return View::make('home.index');
	}
	//JobTitles actions
	public function post_jobtitle(){

		$jobTitle = array(

				'name' 			=> Input::get('name'),
				'description' 	=> Input::get('description'),
				'createdBy'		=> $get_user_id,
				'lastUpdateBy'	=> $get_user_id,
			);

		$id = JobTitle::create_jobtitle($jobTitle);
		return HelperFunction::return_json_data($id,true,"record created");
	}
	public function put_jobtitle(){

		$jobTitle = array(

				'id'			=> Input::get('id'),
				'name' 			=> Input::get('name'),
				'description' 	=> Input::get('description'),
				'lastUpdateBy'	=> $get_user_id
			);

		$id = JobTitle::update_jobTitle($jobTitle);
		$data = HelperFunction::return_json_data($id,true,'record updated');
		echo $data;
		return Response::json($data); }
	public function delete_jobtitle(){

		$id = array('id'=> Input::get('id'));

		$id = JobTitle::delete_jobTitle($id);
		return HelperFunction::return_json_data($id,true,"record deleted ");}
	public function get_jobtitles(){

		// $jobTitle = Input::all();
		// $data = HelperFunction::return_json_data(JobTitle::get_jobTitles($jobTitle),true,'record loaded');
		// return Response::json($data);
		return Response::json(JobTitle::get_jobTitles(Input::all()));}

	//Role Actions
	public function post_role(){

		return Response::json(Role::create_role(Input::json()));
	}
	public function put_role(){

		return Response::json(Role::update_role(Input::json()));
	}
	public function delete_role(){

		return Response::json(Role::delete_role(Input::get('id')));
	}
	public function get_roles(){

		return Response::json(Role::get_roles(Input::all()));
	}

	//project actions
	public function post_create_project(){

			return Response::json(Project::create_project(Input::json()));
	}
	public function put_update_project(){

			return Response::json(Project::update_project(Input::json()));
	}
	public function delete_project(){

			return Reponse::json(Project::delete_project(Input::get('id')));
		}
	public function get_projects(){

		return Response::json(Project::get_projects(Input::all()));
	}
	//project groups actions
	public function post_create_project_group(){

			return Response::json(ProjectGroup::create_project_group(Input::json()));
	}
	public function put_update_project_group(){

			return Response::json(ProjectGroup::update_project_group(Input::json()));
	}
	public function delete_project_group(){

			return Reponse::json(ProjectGroup::delete_project_group(Input::get('id')));
	}
	public function get_project_groups(){

		return Response::json(ProjectGroup::get_project_groups(Input::all()));
	}
	//project User Groups actions
	public function post_create_project_user_group(){

			return Response::json(ProjectUserGroup::create_project_user_group(Input::json()));
	}
	public function put_update_project_user_group(){

			return Response::json(ProjectUserGroup::update_project_user_group(Input::json()));
	}
	public function delete_project_user_group(){

			return Reponse::json(ProjectUserGroup::delete_project_user_group(Input::get('id')));
		}
	public function get_project_user_groups(){

		return Response::json(ProjectUserGroup::get_project_user_groups(Input::all()));
	}

	

	//Priorities actions
	public function post_create_priority(){

		return  Response::json(Priority::create_priority(Input::json()));
	}
	public function put_update_priority(){
		
		return Response::json(Priority::update_priority(Input::json()));
	}
	public function delete_priority(){
		return Reponse::json(Priority::delete_priority(Input::get('id')));
	}
	public function get_priorities(){
		return Response::json(Priority::get_priorities(Input::all()));
	}
	
	public static function get_number(){

		return Response::json(Ticket::generate_id());
	}

	//Dash Board
	public function get_dash_board(){
		return View::make("dashboard.index");
	}
	
}
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
		return HelperFunction::return_json_data($id,true,"record created");}
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

		$clientdata = Input::all();
		$roleArray = array(
							'name' 			=> $clientdata['name'],
						   'description' 	=> $clientdata['description'],
						   'createdBy'		=> HelperFunction::get_user_id(),
						   'lastUpdateBy'	=> HelperFunction::get_user_id()
		 		);

		return  Respons::json(Role::create_role($roleArray));
	}
	public function put_role(){

		$clientdata = Input::all();
		$roleArray = array(	
							'id'			=> $clientdata['id'],
							'name' 			=> $clientdata['name'],
						    'description' 	=> $clientdata['description'],
						   'lastUpdateBy'	=> HelperFunction::get_user_id(),

		 		);

		return Reponse::json(Role::update_role($roleArray));
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

	//ticketStatus Actions
	public function post_ticketstatus(){
		$clientdata = Input::all();
		$ticketStatusArray = array(

						   'name' 			=> $clientdata['name'],
						   'description' 	=> $clientdata['description'],
						   'createdBy'		=> HelperFunction::get_user_id(),
						   'lastUpdateBy'	=> HelperFunction::get_user_id()
		 		);

		return  Response::json(ticketStatus::create_ticket_status($roleArray));}
	public function put_ticketstatus(){

		$client_data = Input::json();
		return Response::json(TicketStatus::create_project($client_data));
		
	}
	public function delete_ticketstatus(){
		return Reponse::json(ticketStatus::delete_ticket_status(Input::get('id')));
	}
	public function get_ticketstatus(){
		return Response::json(ticketStatus::get_ticket_status(Input::all()));
	}

	public function post_tickettype(){

		$clientdata = Input::all();
		$tickettype = array(

						   'name' 			=> $clientdata['name'],
						   'description' 	=> $clientdata['description'],
						   'createdBy'		=> HelperFunction::get_user_id(),
						   'lastUpdateBy'	=> HelperFunction::get_user_id()
		 		);

		return  Response::json(tickettypes::create_ticket_type($tickettype));
	}

	public function put_tickettype(){

		$project = Input::all();
				$tickettype = array(
							'id'			=> $project['id'],
							'name' 			=> $project['name'],
						   'description' 	=> $project['description'],
						   'lastUpdateBy'	=> HelperFunction::get_user_id()
		 		);
				return Response::json(tickettype::update_ticket_type($projectArray));
	}
	public function delete_tickettype(){
		return Reponse::json(tickettype::delete_ticket_type(Input::get('id')));
	}
	public function get_tickettypes(){
		return Response::json(tickettype::get_ticket_type(Input::all()));
	}
	// public function post_create_project(){

	// 	$client_data = Input::json();
	// 	return Group::create_group($client_data);
	// }
}
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

	//ticketStatus
	public function post_ticket_status(){
		
		return Response::json(TicketStatus::create_ticket_status(Input::json()));
	}
	public function put_ticket_status(){

		$client_data = Input::json();
		return Response::json(TicketStatus::update_ticket_status($client_data));
		
	}
	public function delete_ticket_status(){
		return Reponse::json(TicketStatus::delete_ticket_status(Input::get('id')));
	}
	public function get_ticket_statuses(){
		return Response::json(TicketStatus::get_ticket_statuses(Input::all()));
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
	//Tickets
	public function post_ticket(){

		return  Response::json(Ticket::create_ticket(Input::json()));
	}
	public function post_ticket_details($id){
		
		return Response::json(Ticket::create_ticket_details(Input::json()));
	}
	public function put_ticket(){
		
		return Response::json(Ticket::update_ticket(Input::json()));
	}
	public function delete_ticket(){
		return Reponse::json(Ticket::delete_ticket_type(Input::get('id')));
	}
	public function get_tickets(){
		return Response::json(Ticket::get_tickets(Input::all()));
	}
	public function get_ticket_details($id){


		//return Response::json(Ticket::get_ticket_details(Input::all()));

		return Response::json(Ticket::get_ticket_details($id));
	}
	
	//Tickets Types
	public function post_ticket_type(){

		return  Response::json(Ticket::create_ticket_type(Input::json()));
	}
	public function put_ticket_type(){
		
		return Response::json(TicketType::update_ticket_type(Input::json()));
	}
	public function delete_ticket_type(){
		return Reponse::json(TicketType::delete_ticket_type(Input::get('id')));
	}
	public function get_ticket_types(){
		return Response::json(TicketType::get_ticket_types(Input::all()));
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
	public function get_statuses_by_user($ticketId){
		
		return Response::json(TicketStatus::get_ticket_statuses_by_user($ticketId));
	}
}
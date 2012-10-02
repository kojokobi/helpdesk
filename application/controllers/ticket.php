<?php

class Ticket_Controller extends Base_Controller{

	public $restful = true;
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
	public function get_ticket_index(){

		return View::make('tickets.index');
	}
	public function get_ticket_main(){

		return View::make('tickets.main');
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

		
		$client_data = Input::all();
		if(array_key_exists('ticketId',$client_data))
			return Response::json(TicketStatus::get_ticket_statuses_by_user($client_data['ticketId']));
		else
			return Response::json(TicketStatus::get_ticket_statuses(Input::all()));}
	public function get_statuses_by_user($ticketId){
		
		return Response::json(TicketStatus::get_ticket_statuses_by_user($ticketId));
	}
	public function get_single_ticket_view(){
		echo View::make("tickets.single_ticket");
	}
	public function get_tickets_view(){

		return View::make("tickets.index");
	}
	

}
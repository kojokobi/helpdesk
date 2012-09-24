<?php

class Ticket {


	public static function create_ticket($ticket){


		$ticket_array = DataHelper::create_audit_entries(Auth::user()->id);

		$ticket_array['title'] = $ticket->title;
		//$ticket_array['number'] = $ticket->number;
		//tickets by default should ne opened
		//ticket number should be generated automatically on the server
		//
		
		$ticket_array['ticket_status_id'] = $ticket->ticket_status_id;
		$ticket_array['priority_id'] = $ticket->priorityId;
		$ticket_array['assigned_to'] = $ticket->assignedTo;


		$inserted_record = DataHelper::insert_record('tickets',$ticket_array);
        return $inserted_record;

	}
	public static function update_ticket(){

	$ticket_array = DataHelper::update_audit_entries(Auth::user()->id);

		$ticket_array['title'] = $ticket->title;
		$ticket_array['number'] = $ticket->number;
		$ticket_array['ticket_status_id'] = $ticket->ticket_status_id;
		$ticket_array['priority_id'] = $ticket->priorityId;
		$ticket_array['assigned_to'] = $ticket->assignedTo;

		$inserted_record = DataHelper::update_record('tickets',$ticket_array);
        return $inserted_record;

	}
	public static function delete_ticket(){

		//return DB::table('project_user_groups')->delete($id);
	}
	public static function get_tickets($obj){

		$new_filter_array = array();
		if(array_key_exists("ticketId", $obj))
			$new_filter_array['ticket_id']  = $obj['ticketId'];
		if(array_key_exists("number", $obj))
			$new_filter_array['number']  = $obj['number'];
		if(array_key_exists("priorityId", $obj))
			$new_filter_array['priority_id'] = $obj['priorityId'];
		if(array_key_exists("ticketStatusId", $obj))
			$new_filter_array['ticket_status_id'] = $obj['ticketStatusId'];

		$selectQuery = DB::table('ticket_details')
				->join('tickets','ticket_details.ticket_id','=','tickets.id')
				->where(function($query) use ($new_filter_array){


						$query = DataHelper::filter_data($query,'tickets.id',$new_filter_array,'int');
						$query = DataHelper::filter_data($query,'number',$new_filter_array,'string');
						$query = DataHelper::filter_data($query,'priority_id',$new_filter_array,'int');

				})
		->order_by('project_groups.id','desc');
		//get total count 
		$total =$selectQuery->count();
		$result_set = $selectQuery->get(

			array(
					'project_groups.id as id','project_groups.name as project_group_name','project_groups.project_id','projects.name as project_name',
						'project_groups.description','project_groups.created_at'
						)
		);
		//var_dump($selectQuery);
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['name']		= $data->project_group_name;
			$arr['projectId']	= $data->project_id;
			$arr['projectName']	= $data->project_name;
			$arr['description']	= $data->description;
			$arr['createdAt']	= $data->created_at;
			

			return $arr;
		},$result_set);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);
	};




}
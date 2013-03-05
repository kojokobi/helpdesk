<?php

class Ticket extends Eloquent{


	public static function create_ticket($ticket){

	try{
		//validate_user_input($input,$rules)
		// $input = array(

		// 	);

		$result = 	DB::transaction(function() use ($ticket) {
		
		$ticket_array = DataHelper::create_audit_entries(Auth::user()->id);
		//todo:change this
		$ticket_array['ticket_status_id'] = config::get('globalconfig.default_ticket_status');
		$ticket_array['priority_id'] = $ticket->priorityId;
		$ticket_array['assigned_to'] = $ticket->assignedId;
		$ticket_array['title'] = $ticket->title;
		$ticket_array['ticket_type_id'] = $ticket->ticketTypeId;
		$ticket_array['project_id'] = $ticket->projectId;
		
		$id = DB::table('tickets')->insert_get_id(
				$array = $ticket_array
			);
		
		DB::table('tickets')
			->where('id','=',$id)
			->update(
					$update_array = array('number'=>Date('Ymd') . $id)
			);

		//insert into ticket_details
		$ticket_details_array = DataHelper::create_audit_entries(Auth::user()->id);
		$ticket_details_array['ticket_id'] = $id;
		$ticket_details_array['message'] = $ticket->message;
		$ticket_details_array['status_id'] = config::get('globalconfig.default_ticket_status');

		$ticket_details_id	= DB::table('ticket_details')->insert_get_id(

				$ticket_details = $ticket_details_array
			);

		//$ret_value = DataHelper::inserted_record('ticket_details',$ticket_details_array);
		//$data =null,$success = false,$message="",$total=0
		return array('id'=>$ticket_details_id);
		

		});
		return DataHelper::return_json_data($result,true,"Ticket created successfully");
	}catch(Exception $e){
		return HelperFunction::catch_error($e,true,Config::get("globalconfig.global_error_message"));
	}

	}
	public static function create_ticket_details($ticket){

		//only allow replies if status_id is not closed
		$ticket_details_array = DataHelper::create_audit_entries(HelperFunction::get_user_id());

		$ticket_details_array['message'] = $ticket->message;
		$ticket_details_array['ticket_id'] = $ticket->ticketId;
		$ticket_details_array['status_id'] = $ticket->ticketStatusId;
		
		$record = DB::table('ticket_details')
				  ->where(function($query) use ($ticket_details_array){

				  		$query->where('ticket_id','=',$ticket_details_array['ticket_id']);
				  		$query->where('status_id','=',Config::get("globalconfig.closed_ticket_status_id"));
				 
				  })->get();

		
		if(array_key_exists(0,$record))
			return HelperFunction::catch_error(null,false,"can't reply to a closed ticket");

			$inserted	= DB::transaction(function() use ($ticket_details_array) {
			
			$inserted_record = DataHelper::insert_record('ticket_details',$ticket_details_array);
			$update_record_array =  array(
										
										'ticket_status_id'=>$ticket_details_array['status_id'],
										'updated_by' => Auth::user()->id,
										'updated_at' => HelperFunction::get_date(),
									);
			//$update_record = DataHelper::update_record('tickets',$ticket_details_array['status_id'],$update_record_array);
			DB::table('tickets')
				->where('id','=',$ticket_details_array['ticket_id'])
				->update(
						array('ticket_status_id'=>$ticket_details_array['status_id'])
					);
			return $inserted_record;
			
		});
		return DataHelper::return_json_data($inserted,true,"reply posted succesfully");
  
	}
	public static function delete_ticket(){

		//return DB::table('project_user_groups')->delete($id);
	}
	public static function get_tickets($obj){

		$new_filter_array = array();
		if(array_key_exists("ticketId", $obj))
			$new_filter_array['ticket_id']  = $obj['ticketId'];
		if(array_key_exists("projectId", $obj))
			$new_filter_array['project_id']  = $obj['projectId'];
		if(array_key_exists("priorityId", $obj))
			$new_filter_array['priority_id'] = $obj['priorityId'];
		if(array_key_exists("ticketStatusId", $obj))
			$new_filter_array['ticket_status_id'] = $obj['ticketStatusId'];
		if(array_key_exists("assignedTo", $obj))
			$new_filter_array['assigned_to'] = $obj['assignedTo'];

		$selectQuery = DB::table('tickets')
				//->join('tickets','ticket_details.ticket_id','=','tickets.id')
				->join('ticket_statuses','tickets.ticket_status_id','=','ticket_statuses.id')
				->join('priorities','tickets.priority_id','=','priorities.id')
				->join('users as user_to','tickets.assigned_to','=','user_to.id')
				->join('users as user_from','tickets.created_by','=','user_from.id')
				->join('ticket_types','tickets.ticket_type_id','=','ticket_types.id')
				->join('projects','tickets.project_id','=','projects.id')
				->where(function($query) use ($new_filter_array){


						$query = DataHelper::filter_data($query,'tickets.id',$new_filter_array,'int');
						$query = DataHelper::filter_data($query,'number',$new_filter_array,'string');
						$query = DataHelper::filter_data($query,'priority_id',$new_filter_array,'int');
						$query = DataHelper::filter_data($query,'project_id',$new_filter_array,'int');

				})
		->order_by('tickets.id','desc');
		//get total count 
		$total =$selectQuery->count();
		$result_set = $selectQuery->get(

			array(
					'tickets.id as id','number','ticket_statuses.id as ticket_status_id','ticket_statuses.name as ticket_status',
						'priority_id','priorities.name as priorityname','tickets.title','tickets.assigned_to',
						'user_to.first_name as user_to_first_name','user_to.last_name as user_to_last_name',
						'user_from.first_name as user_from_first_name','user_from.last_name as user_from_last_name',
							'tickets.ticket_type_id','ticket_types.name as ticket_type','tickets.created_at','tickets.project_id'
				)
		);
		//var_dump($selectQuery);
		$out = array_map(function($data){

			$arr = array();
			$arr['id']	= $data->id;
			$arr['ticketStatusId'] 	= $data->ticket_status_id;
			$arr['ticketStatus'] 	= $data->ticket_status;
			$arr['priorityId'] 	= $data->priority_id;
			$arr['priority'] 	= $data->priorityname;
			$arr['assignedId'] 	= $data->assigned_to;

			$arr['assignedTo'] 	= $data->user_to_first_name . ' ' . $data->user_to_last_name;
			$arr["assignedFrom"] = $data->user_from_first_name . ' '. $data->user_from_last_name;
			//$arr['message'] 	= $data->message;
			$arr['ticketTypeId'] = $data->ticket_type_id;
			$arr['ticketType'] = $data->ticket_type;
			$arr['title']		= $data->title;
			$arr['number']		= $data->number;
			$arr['projectId']		= $data->project_id;
			//$arr['description']	= $data->description;
			$arr['createdAt']	= $data->created_at;
			

			return $arr;
		},$result_set);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);
	}
	public static function get_ticket_details($id){
		
		
		$new_filter_array = array();
		//set the filter value $id to the array index "tickets.id".
		//should be the same as the name of the database column to filter the data on
		$new_filter_array['tickets.id'] = $id;
		//select from tickets and all related tables to retrive ticket with id=$id
		$ticket_result_set = DB::table('tickets')
				->join('ticket_statuses','tickets.ticket_status_id','=','ticket_statuses.id')
				->join('priorities','tickets.priority_id','=','priorities.id')
				->join('users','tickets.assigned_to','=','users.id')
				->join('ticket_types','tickets.ticket_type_id','=','ticket_types.id')
				//->join('projects','tickets.project_id','=','projects.id')
				->where(function($query)use($new_filter_array){

					$query = DataHelper::filter_data($query,'tickets.id',$new_filter_array,'int');
				})->get(
						//specify the columns you to to get data from
					array(
							'tickets.id as id','number','ticket_statuses.id as ticket_status_id','ticket_statuses.name as ticket_status',
								'priority_id','priorities.name as priorityname','tickets.title','tickets.assigned_to','users.first_name','users.last_name',
									'tickets.ticket_type_id','ticket_types.name as ticket_type','tickets.created_at'
					)
				);
		//to comply with javascript naming conventions assign the 
		//the columns selected to a new array through the array_map php function
		$out_tickets = array_map(function($data){

			$arr = array();
			$arr['id']	= $data->id;
			$arr['ticketStatusId'] 	= $data->ticket_status_id;
			$arr['ticketStatus'] 	= $data->ticket_status;
			$arr['priorityId'] 	 = $data->priority_id;
			$arr['priority'] 	 = $data->priorityname;
			$arr['assignedId'] 	 = $data->assigned_to;
			$arr['assignedTo'] 	 = $data->first_name . ' ' . $data->last_name;
			$arr['ticketTypeId'] = $data->ticket_type_id;
			$arr['ticketType'] 	 = $data->ticket_type;
			$arr['title']		 = $data->title;
			$arr['number']		 = $data->number;
			$arr['createdAt']	 = $data->created_at;
			
			//return the array caontaining the new recordset
			return $arr;
		},$ticket_result_set);

		//Select data from Ticket_Details table
		$ticket_details_filter = array();
		$ticket_details_filter['ticket_id'] = $id;
		//
		$ticket_details_query = DB::table('ticket_details')
				->join('ticket_statuses','ticket_details.status_id','=','ticket_statuses.id')
				->where(function($query)use($ticket_details_filter){

					$query = DataHelper::filter_data($query,'ticket_id',$ticket_details_filter,'int');
				})
		->order_by('ticket_details.id','desc');
		//get total count 
		$total 		=$ticket_details_query->count();
		//specify columns to retrive from query
		$result_set =$ticket_details_query ->get(

					array(
							'ticket_details.message','ticket_details.id as ticket_details_id','ticket_details.created_at',
								'ticket_id as ticketid','status_id','ticket_statuses.name as statusname'
					)
				);
		//map ticket details resultSet to outTicketDetails array
		$out_ticket_details = array_map(function($data){

			$arr = array();
			$arr['ticketDetailsId'] = $data->ticket_details_id;
			$arr['message'] = $data->message;
			$arr['createdAt'] = $data->created_at;
			$arr['ticketId'] = $data->ticketid;
			$arr['ticketStatusId'] = $data->status_id;
			$arr['ticketStatus'] = $data->statusname;


			return $arr;
		},$result_set);

		//add outticketDetails array object to outTickets array
		$out_tickets[0]['thread'] = $out_ticket_details;
		return HelperFunction::return_json_data($out_tickets,true,'record loaded',$total);
		
	}
	public static function generate_id(){

		$ret = DataHelper::insert_and_update('sample',array(),'id','=','generated',Date('Ymd'));
		return DataHelper::return_json_data($ret,true,'record inserted',0);
	}




}
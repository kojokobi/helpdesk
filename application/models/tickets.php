<?php

class Ticket {


	public static function create_ticket($ticket){


	$result = 	DB::transaction(function() use ($ticket) {
			
		$ticket_array = DataHelper::create_audit_entries(Auth::user()->id);
		$ticket_array['ticket_status_id'] = 1;//ticketStatus is always bydefault set to 1=opened
		$ticket_array['priority_id'] = $ticket->priorityId;
		$ticket_array['assigned_to'] = $ticket->assignedId;
		$ticket_array['title'] = $ticket->title;
		//$ticket_array['ticket_type_id'] = $ticket->ticketTypeId
		//$ticket_array['ticket_type_id'] = 1;
		//$ticket_array['message'] = $ticket->message;

		$id = DB::table('tickets')->insert_get_id(
				$array = $ticket_array
			);
		//insert_get_id($table_name,$insert_parameters_array)
		//first into 'tickets table'
	//$id = DataHelper::insert_get_id('tickets',$ticket_array);
		//add ticket number 
		//update_record($table_name,$value,$update_parameters_array,$key='id',$operator='=')
	//$update = DataHelper::update_record('tickets',$id,array('number'=>Date('Ymd') + $id));
		DB::table('tickets')
			->where('id','=',$id)
			->update(
					$update_array = array('number'=>Date('Ymd') . $id)
			);

		//insert into ticket_details
		$ticket_details_array = DataHelper::create_audit_entries(Auth::user()->id);
		$ticket_details_array['ticket_id'] = $id;
		$ticket_details_array['message'] = $ticket->message;

		$ticket_details_id	= DB::table('ticket_details')->insert_get_id(

				$ticket_details = $ticket_details_array
			);

		//$ret_value = DataHelper::inserted_record('ticket_details',$ticket_details_array);
		//$data =null,$success = false,$message="",$total=0
		return array('id'=>$ticket_details_id);
		

		});
		return DataHelper::return_json_data($result,true,"Ticket created successfully");

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
		if(array_key_exists("assignedTo", $obj))
			$new_filter_array['assigned_to'] = $obj['assignedTo'];

		$selectQuery = DB::table('tickets')
				->join('ticket_statuses','ticket_status_id','=','ticket_statuses.id')
				->join('priorities','priority_id','=','priority_id')
				->join('users','assigned_to','=','users.id')
				->where(function($query) use ($new_filter_array){


						$query = DataHelper::filter_data($query,'tickets.id',$new_filter_array,'int');
						$query = DataHelper::filter_data($query,'number',$new_filter_array,'string');
						$query = DataHelper::filter_data($query,'priority_id',$new_filter_array,'int');
						$query = DataHelper::filter_data($query,'priority_id',$new_filter_array,'int');

				})
		->order_by('tickets.id','desc');
		//get total count 
		$total =$selectQuery->count();
		$result_set = $selectQuery->get(

			array(
					'tickets.id as id','number','ticket_statuses.id','ticket_statuses.name','priority_id','priorities.name','title',
						'tickets.created_at'
				)
		);
		//var_dump($selectQuery);
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['title']		= $data->title;
			$arr['number']		= $data->number;
			//$arr['description']	= $data->description;
			$arr['createdAt']	= $data->created_at;
			

			return $arr;
		},$result_set);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);
	}
	public static function generate_id(){

		//insert_and_update($table_name,$insert_parameters_array,$key='id',$operator='=',$update_field,$value)
		//$new_record = $arrayName();
		$ret = DataHelper::insert_and_update('sample',array(),'id','=','generated',Date('Ymd'));

		//$r = __()->_uniqueId('stooge_');
		//var_dump($r);
		//$r = __uniqueId('st');
		//$p = new __();
		//$id=__(uniqId('T'));
		// DB::table('sample')->insert(

		// 		$array=array(
		// 			'generated'=>
		// 		)
		// 	);
		return DataHelper::return_json_data($ret,true,'record inserted',0);
	}




}
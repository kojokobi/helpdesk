<?php

class TicketStatus extends Eloquent{
	
	
	public static function create_ticket_status($ticketStatus){

			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
            $grp_array['name'] = $ticketStatus->name;
            $grp_array['description'] = $ticketStatus->description;

            $inserted_record = DataHelper::insert_record('ticket_statuses',$grp_array);
            return $inserted_record;
			
	}
	public static function update_ticket_status($ticketStatus){

			$grp_array = DataHelper::update_audit_entries(Auth::user()->id);
            $grp_array['name'] = $ticketStatus->name;
            $grp_array['description'] = $ticketStatus->description;

            $inserted_record = DataHelper::update_record('ticket_statuses',$grp_array);
            return $inserted_record;
	}
	public static function delete_ticket_status($ticketStatus){

		DB::table('ticket_statuses')->delete($ticketStatus['id']);

	}
	public static function get_ticket_statuses($obj = null){

		$selectQuery = DB::table('ticket_statuses')
  					->where(function($query) use ($obj){
						$query = DataHelper::filter_data($query,'id',$obj,'int');
						$query = DataHelper::filter_data($query,'name',$obj,'string');
				});
					
		$data = DataHelper::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
	/**
	 * Selects tickets statuses filtered by the current users Id and a ticketId.
	 * 
	 * @param  int 		[$ticketId] [Id of a ticket]
	 * @return json 	a json object containing statuses 
	 */
	public static function get_ticket_statuses_by_user($ticketId){
		try{


			$user_id = Auth::user()->id;
			$result = DB::table('tickets')
				->where(function($query) use($ticketId,$user_id){

					$query->where('id','=',$ticketId);
					$query->where('created_by','=',$user_id);

				})->get(
					array('id' )
				);
				
		$out = array_map(function($data){

			$arr = array();
			$arr["id"] = $data->id;
			return $arr;

		}, $result);
				
		if(array_key_exists(0, $out)){
			return TicketStatus::get_ticket_statuses();
		}
			return TicketStatus::get_without_closed_status();
	}catch(Exception $e){

		return return_json_data(array(),false,$e);
	}
		
	}
	/**
	 * Selects statuses where status name is not equal to closed
	 * @return [json] [a json object containing statuses ]
	 */
	public static function get_without_closed_status(){

		$result = DB::table('ticket_statuses')
				->where(function($query){

					$query->where('name','!=','closed');

				})->get();

		return  DataHelper::return_json_data($result,true,'record loaded');
	}
} 
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
}
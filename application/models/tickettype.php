<?php

class TicketType extends Eloquent{
	
	
	public static function create_ticket_type($ticket_type){

			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
            $grp_array['name'] = $ticket_type->name;
            $grp_array['description'] = $ticket_type->description;

            $inserted_record = DataHelper::insert_record('ticket_types',$grp_array);
            return $inserted_record;
	}
	public static function update_ticket_type($ticket_type){

			$grp_array = DataHelper::update_audit_entries(Auth::user()->id);
            $grp_array['name'] = $ticket_type->name;
            $grp_array['description'] = $ticket_type->description;

            $inserted_record = DataHelper::update_record('ticket_types',$grp_array);
            return $inserted_record;
	}
	public static function delete_ticket_type($ticketTypeId){

		DB::table('ticket_types')->delete($ticketTypeId);

	}
	public static function get_ticket_types($obj = null){

		$selectQuery = DB::table('ticket_types')

					->where(function($query) use ($obj){
						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
				});
					
		$data = DataHelper::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
<?php

class TicketStatus extends Eloquent{
	
	
	public static function create_ticket_status($ticketStatus){

			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$id = DB::table('ticketStatuss')->insert_get_id(
					$arrayName = array(

							'name' 			=>	$ticketStatus['name'],
							'description'	=>  $ticketStatus['description'],
							'createdDate' 	=>  $createdDate,
							'lastUpdateDate'=>  $lastUpdatedDate,
							'createdBy'		=>	$ticketStatus['createdBy'],
							'lastUpdateBy'	=>	$ticketStatus['lastUpdateBy']
                            
						)
				);
			
		$data = HelperFunction::return_json_data($id,true,'record loaded');
		return $data;
	}
	public static function update_ticket_status($ticketStatus){

			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$update = DB::table('ticketStatuss')
						->where('id','=',$ticketStatus['id'])
						->update($arrayName = array(

							'id' 			 =>	$ticketStatus['id'],
							'name' 			 =>	$ticketStatus['name'],
							'description'	 => $ticketStatus['description'],
							'lastUpdateDate' => $lastUpdatedDate,
							'lastUpdateBy'	 =>	$ticketStatus['lastUpdateBy']

							)
						);
			$data = HelperFunction::return_json_data($update,true,'record loaded');
			return $data;
	}
	public static function delete_ticket_status($ticketStatus){

		DB::table('ticketStatuss')->delete($ticketStatus['id']);

	}
	public static function get_ticket_status($obj = null){

		$selectQuery = DB::table('ticketStatuss')

					->where(function($query) use ($obj){
						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
				});
					
		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
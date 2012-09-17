<?php

class TicketType extends Eloquent{
	
	
	public static function create_ticket_type($ticket){

			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

            

			$id = DB::table('ticketTypes')->insert_get_id(
					$arrayName = array(

							'name' 			=>	$ticketType['name'],
							'description'	=>  $ticketType['description'],
							'createdDate' 	=>  $createdDate,
							'lastUpdateDate'=>  $lastUpdatedDate,
							'createdBy'		=>	$ticketType['createdBy'],
							'lastUpdateBy'	=>	$ticketType['lastUpdateBy']
						)
				);
			
		$data = HelperFunction::return_json_data($id,true,'record loaded');
		return $data;
	}
	public static function update_ticket_type($ticket){

			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$update = DB::table('ticketTypes')
						->where('id','=',$ticketType['id'])
						->update($arrayName = array(

							'id' 			 =>	$ticketType['id'],
							'name' 			 =>	$ticketType['name'],
							'description'	 => $ticketType['description'],
							'lastUpdateDate' => $lastUpdatedDate,
							'lastUpdateBy'	 =>	$ticketType['lastUpdateBy']

							)
						);
			$data = HelperFunction::return_json_data($update,true,'record loaded');
			return $data;
	}
	public static function delete_ticket_type($ticket){

		DB::table('ticketTypes')->delete($ticketTypeId);

	}
	public static function get_ticket_type($obj = null){

		$selectQuery = DB::table('ticketTypes')

					->where(function($query) use ($obj){
						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
				});
					
		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
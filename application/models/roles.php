<?php

class Role extends Eloquent{
	
	
	public static function create_role($role){

			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			$id = DB::table('roles')->insert_get_id(
					$arrayName = array(

							'name' =>	$role['name'],
							'description'	=> $role['description'],
							'createdDate' 	=>  $createdDate,
							'lastUpdateDate' => $lastUpdatedDate,
							'createdBy'		=>	$role['createdBy'],
							'lastUpdateBy'	=>	$role['lastUpdateBy']
						)
				);
			
		$data = HelperFunction::return_json_data($id,true,'record loaded');
		return $data;
	}
	public static function update_role($role){

			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$update = DB::table('roles')
						->where('id','=',$role['id'])
						->update($arrayName = array(

							'id' 			 =>	$role['id'],
							'name' 			 =>	$role['name'],
							'description'	 => $role['description'],
							'lastUpdateDate' => $lastUpdatedDate,
							'lastUpdateBy'	 =>	$role['lastUpdateBy']

							)
						);
			$data = HelperFunction::return_json_data($update,true,'record loaded');
			return $data;
	}
	public static function delete_role($roleId){

		DB::table('roles')->delete($roleId);

	}
	public static function get_roles($obj = null){

		$selectQuery = DB::table('roles')

					->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');

				});
					
		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
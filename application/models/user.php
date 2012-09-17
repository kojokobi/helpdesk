<?php

class User extends Eloquent{

	
	
	public static function create_user($user){

	$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
	$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));


			$id = DB::table('users')->insert_get_id(

					$arrayName = array(

							'firstName' 	=>	$user['firstName'],
							'lastName'		=> $user['lastName'],
							'userName'		=> 	$user['userName'],
							'otherNames'	=> $user['otherNames'],
							'email'			=> $user['email'],
							'phone'			=> $user['phone'],
							//'password'		=>  Hash::make($user['password']),
							'password'		=>  $user['password'],
							'jobTitleId'	=>	$user['jobTitleId'],
							'roleId'		=>	$user['roleId'],
							//'pictureFileName'	=> $user['pictureFileName']
							'createdDate'	=>	$createdDate,
							'lastUpdateDate'=>  $lastUpdatedDate,
							'createdBy'		=>	$user['createdBy'],
							'lastUpdateBy'	=>	$user['lastUpdateBy']
						)
				);
		$data = HelperFunction::return_json_data(array('id' => $id),true,'record saved');
		return $data;
	}

	
	public static function update_user($user){

		$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
		$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			$id = DB::table('users')
						->where('id','=',$user['id'])
						->update($arrayName = array(

							'id' =>		$user['id'],
							'firstName' 	=>	$user['firstname'],
							'lastName'		=> $user['lastName'],
							'userName'		=> 	$user['userName'],
							'otherNames'	=> $user['otherNames'],
							'email'			=> $user['email'],
							'phone'			=> $user['phone'],
							'jobTitleId'	=>	$user['jobTitleId'],
							//'pictureFileName'	=> $user['pictureFileName'],
							'roleId'		=>	$user['roleId'],
							'lastUpdateDate'=> $this->lastUpdateDate,
							'lastUpdateBy'	=>	$user['lastUpdateBy']

							)
						);
			$data = HelperFunction::return_json_data(array('id' => $arrayName),true,'record saved');
			return $data;

	}
	public static function delete_user($id){

		//DB::table('users')->where('id','=',$userId)->delete();
		return DB::table('users')->delete($id);
	}
	public static function get_users($obj){

		$selectQuery = DB::table('users')
					   ->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'firstname',$obj,'string');
						$query = HelperFunction::filter_data($query,'lastName',$obj,'string');
						$query = HelperFunction::filter_data($query,'jobTitleId',$obj,'int');
						$query = HelperFunction::filter_data($query,'roleId',$obj,'int');

				});

		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
<?php

class User extends Eloquent{

	
	
	public static function create_user($user){

			$arr = DataHelper::create_audit_entries(Auth::user()->id);
			$arr['first_name']	= $$user->firstName;
			$arr['last_name']	= $$user->lastName;
			$arr['user_name']	= $user->userName;
			$arr['other_names']	= $user->otherNames;
			$arr['email']		= $user->email;
			$arr['phone']		= $user->phone;
			$arr['job_title_id']	= $user->jobTitleId;
			$arr['role_id']		= $user->roleId;
			$arr['password']	= Hash::make($user->password);
			
			$inserted_record = DataHelper::insert_record('users',$arr);
			return $inserted_record;
		
	}

	
	public static function update_user($user){

			$arr = DataHelper::update_audit_entries(Auth::user()->id);
			$arr['first_name']	= $$user->firstname;
			$arr['last_name']	= $$user->lastname;
			$arr['user_name']	= $user->username;
			$arr['other_names']	= $user->othernames;
			$arr['email']		= $user->email;
			$arr['phone']		= $user->phone;
			$arr['job_title_id']	= $user->jobTitleId;
			$arr['role_id']		= $user->roleId;
			$arr['password']	= Hash::make($user->password)

			$updated_record = DataHelper::update_record('users',$user->id,$arr);
            return $updated_record;

	}
	public static function delete_user($id){

		//DB::table('users')->where('id','=',$userId)->delete();
		return DB::table('users')->delete($id);
	}
	public static function get_users($obj){

		$selectQuery = DB::table('users')
					   ->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'first_name',$obj,'string');
						$query = HelperFunction::filter_data($query,'last_name',$obj,'string');
						$query = HelperFunction::filter_data($query,'job_title_id',$obj,'int');
						$query = HelperFunction::filter_data($query,'role_id',$obj,'int');

				});
		//get total count 
		$total =$selectQuery->count();
		$resultSet = $selectQuery->get();

		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['first_name']	= $data->firstname;
			$arr['last_name']	= $data->lastname;
			$arr['user_name']	= $data->username;
			$arr['other_names']	= $data->othernames;
			$arr['email']		= $data->email;
			$arr['phone']		= $data->phone;

			return $arr;
		},$resultSet);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);
		
	}
}
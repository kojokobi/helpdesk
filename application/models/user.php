<?php

class User extends Eloquent{

	
	
	public static function create_user($user){

			$inputs = array('firstName'=>$user->firstName,'lastName'=>$user->lastName,'password'=>$user->password,
								'email'=>$user->email,'jobTitleId'=>$user->jobTitleId,'userName'=>$user->userName,
									'roleId'=>$user->roleId);
			
			$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('user_rules'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

			$arr = DataHelper::create_audit_entries(Auth::user()->id);
			$arr['first_name']	= $user->firstName;
			$arr['last_name']	= $user->lastName;
			$arr['user_name']	= $user->userName;
			$arr['email']		= $user->email;
			$arr['job_title_id']	= $user->jobTitleId;
			$arr['role_id']		= $user->roleId;
			$arr['password']	= Hash::make($user->password);
			
			$inserted_record = DataHelper::insert_record('users',$arr);
			return $inserted_record;
		
	}
	public static function update_user_profile($user_update){

		try{
				$inputs = array('firstName'=>$user_update->firstName,'lastName'=>$user_update->lastName,
										'userName'=>$user_update->userName,'email'=>$user_update->email);
				$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('update_user_profile_rule'));
				if($validation->fails())
					return $validation->errors;

				$arr = DataHelper::update_audit_entries(HelperFunction::get_user_id());
				$arr['id']	= HelperFunction::get_user_id();
				$arr['first_name']	= $user_update->firstName;
				$arr['last_name']	= $user_update->lastName;
				$arr['user_name']	= $user_update->userName;
				$arr['email']		= $user_update->email;

				$updated_record = DataHelper::update_record('users',$arr['id'],$arr);
	            return $updated_record;

        }catch(Exception $e){
        	return;
        }
	}
	public static function change_password($password){

		//oldPassword, newPassword, confirmPassword
		$inputs = array('oldPassword'=>$password->oldPassword,'newPassword'=>$password->newPassword,'confirmPassword'=>$password->confirmPassword);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('change_password'));
		if($validation->fails())
			return HelperFunction::catch_error(null,false,$validation->errors.all());

		$update_array = array();
		$update_array = DataHelper::update_audit_entries(HelperFunction::get_user_id());
		$update_array['id'] = HelperFunction::get_user_id();
		if($password->oldPassword == $password->newPassword)
			$update_array['password'] = Hash::make($password->newPassword);
		//$update_array['confirmPassword'] = $password->confirmPassword;
		//$update_array['password'] 
		$updated_record = DataHelper::update_record('users',$update_array['id'],$update_array);
        return $updated_record;
	}
	public static function update_user($user){

			$arr = DataHelper::update_audit_entries(Auth::user()->id);
			$arr['firstName']	= $$user->first_name;
			$arr['lastName']	= $$user->last_name;
			$arr['userName']	= $user->user_name;
			//$arr['other_names']	= $user->othernames;
			$arr['email']		= $user->email;
			$arr['phone']		= $user->phone;
			$arr['jobTitleId']	= $user->job_title_id;
			$arr['roleId']		= $user->role_id;
			$arr['password']	= Hash::make($user->password);

			$updated_record = DataHelper::update_record('users',$user->id,$arr);
            return $updated_record;

	}
	public static function delete_user($id){

		//DB::table('users')->where('id','=',$userId)->delete();
		return DB::table('users')->delete($id);
	}
	public static function get_users($obj){

		$selectQuery = DB::table('users')
					   ->join('roles','users.role_id','=','roles.id')
					   ->join('job_titles','users.job_title_id','=','job_titles.id')
					   ->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'first_name',$obj,'string');
						$query = HelperFunction::filter_data($query,'last_name',$obj,'string');
						$query = HelperFunction::filter_data($query,'job_title_id',$obj,'int');
						$query = HelperFunction::filter_data($query,'role_id',$obj,'int');

				})
				->order_by('users.id','desc');
		//get total count 
		$total =$selectQuery->count();
		$resultSet = $selectQuery->get(

			array('users.id','first_name','last_name','user_name','email','phone','role_id','roles.name as role_name' ,
				'job_title_id','job_titles.name as job_title')
		);
		//var_dump($resultSet);
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['firstName']	= $data->first_name;
			$arr['lastName']	= $data->last_name;
			$arr['userName']	= $data->user_name;
			$arr['email']		= $data->email;
			$arr['phone']		= $data->phone;
			$arr['roleId']		= $data->role_id;
			$arr['role']		= $data->role_name;
			$arr['jobTitleId']		= $data->job_title_id;
			$arr['jobTitle']		= $data->job_title;

			return $arr;
		},$resultSet);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);
		
	}
	
}

<?php
	class Permission extends Eloquent{


		public static function create_permissions($client_data){

		$input = array('module_id'=>$client_data->module_id,'securable_id'=>$client_data->securable_id);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_permisson_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

		$module_array = HelperFunction::create_audit_entries(HelperFunction::get_user_id());
		$module_array['module_id'] = $client_data->name;
		$module_array['securable_id'] = $client_data->displayName;
		$module_array['priveleges'] = $client_data->roleId;

		return DataHelper::insert_record('modules',$module_array);

	}
	public static function update_permissions($client_data){

		$input = array('module_id'=>$client_data->module_id,'securable_id'=>$client_data->securable_id);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_permisson_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

		$module_array = HelperFunction::update_audit_entries(HelperFunction::get_user_id());
		$module_array['module_id'] = $client_data->name;
		$module_array['securable_id'] = $client_data->displayName;
		$module_array['priveleges'] = $client_data->roleId;

		return DataHelper::update_record('modules',$module_array);

	}
	public static function get_permissions($obj){


		$selectQuery = DB::table('permissions')
				->join('modules','module_id','=','modules.id')
				->join('securables','securable_id','=','securables.id')
				->join('roles','role_id','=','roles.id')
				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'role_id',$obj,'string');
						$query = HelperFunction::filter_data($query,'module_id',$obj,'string');
						$query = HelperFunction::filter_data($query,'securable_id',$obj,'string');

				})
				->order_by('id','desc');
		//get total count 
		$total =$selectQuery->count();
		$resultSet = $selectQuery->get(array('permissions.id','permissions.securable_id','securables.name as securable','securables.display_name',
										'permissions.role_id','roles.name as role','permissions.module_id','modules.name as module_name','permissions.priveleges'));
	
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['securableId']		= $data->securable_id;
			$arr['securable']	= $data->securable;
			$arr['displayName']	= $data->display_name;
			$arr['roleId']	= $data->role_id;
			$arr['role']	= $data->role;
			$arr['moduleId']	= $data->module_id;
			$arr['module']	= $data->module_name;
			$arr['priveleges']	= $data->priveleges;
			

			return $arr;
		},$resultSet);
				
		$data = HelperFunction::return_json_data($out,true,'record loaded',$total);
		return $data;
	}

	}
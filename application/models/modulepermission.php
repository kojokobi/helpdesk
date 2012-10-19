<?php

class ModulePermission extends Eloquent{

	/**
	 * A method or function to save module information to the db
	 * @param  [object] $client_data [an object containing json form data]
	 * @return [json]              []
	 */
	public static function create_module_permission($client_data){

		try{
		//array to hold values to be inserted or updated
		// print_r(json_decode($client_data->permissions[0]));
		// return;
		$filter_array = array();
		$filter_array['module_id'] = $client_data->moduleId;
		$filter_array['role_id'] = $client_data->roleId;
		$filter_array['privileges'] = serialize($client_data->permissions);
	
		$exists = DB::table('module_permissions')->where(

				function($query) use($filter_array) {
					$query->where('module_id','=',$filter_array['module_id']);
					$query->where('role_id','=',$filter_array['role_id']);
				}
			)->first();

		if(is_null($exists)){
				//Since no record exists with this role_id and module_id an insert should be performed
			$inputs = array('moduleId'=>$client_data->moduleId,'roleId'=>$client_data->roleId,'permissions'=>$client_data->permissions);
				$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_module_permission_rule'));
				if($validation->fails())
					return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));
			$module_array = array();
			$module_array = DataHelper::create_audit_entries(HelperFunction::get_user_id());
			$module_array['module_id'] = $client_data->moduleId;
			$module_array['role_id'] = $client_data->roleId;
			$module_array['privileges'] = serialize($client_data->permissions);//$client_data->permissions;
		
		return  DataHelper::insert_record('module_permissions',$module_array);
		}else{
				//Do an Update here
				 DB::table('module_permissions')->where(
					function($query) use($filter_array) {
						$query->where('module_id','=',$filter_array['module_id']);
						$query->where('role_id','=',$filter_array['role_id']);
					}
			)->update(
				$arr_upate = $filter_array
			);
			return DataHelper::return_json_data($arr_upate,true,"Module Permissions Updated");
		}
		

	}catch(Exception $e){
		return HelperFunction::catch_error($e,true);
	}
}
	public static function update_module($client_data){

		try{

		$inputs = array('module_id'=>$client_data->moduleId,'role_id'=>$client_data->roleId);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_module_permission_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

		$module_array = DataHelper::update_audit_entries(HelperFunction::get_user_id());
		$module_array['module_id'] = $client_data->moduleId;
		$module_array['role_id'] = $client_data->roleId;
		$module_array['privileges'] = $client_data->privileges;

		return DataHelper::update_record('modules',$module_array);

	}catch(Exception $e){
		return HelperFunction::catch_error($e,true);
	}
}
	public static function delete_module(){



	}
	public static function get_module_permissions($client_data){

			$filter_array = Array();
			if(array_key_exists('moduleId', $client_data))
				$filter_array['module_id'] = $client_data['moduleId'];
			if(array_key_exists('roleId', $client_data))
				$filter_array['role_id'] = $client_data['roleId'];
			
			$query_result = DB::table('module_permissions')
							// ->join('modules','module_permissions.module_id','modules.id')
							// ->join('roles','module_permissions.role_id','roles.id')
							->where(function($query) use ($filter_array){

								$query = DataHelper::filter_data($query,'module_id',$filter_array,'int');
								$query = DataHelper::filter_data($query,'role_id',$filter_array,'int');
								

							})->order_by('module_permissions.id','desc');

			$total = $query_result->count();
			$result = $query_result->get(

					array('module_permissions.privileges')
				);

			$out = array_map(function($data){

			$arr = array();
			$arr['privileges']	= unserialize($data->privileges);
			
			return $arr;
		},$result);
		
		return  HelperFunction::return_json_data($out,true,'record loaded',$total);
		
			
	}
	public static function get_modules_array(){

		$data = DataHelper::return_json_data(HelperFunction::get_config('module_permissions'),true,"data loaded");
		return $data;
	}

}
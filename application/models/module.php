<?php

class Module extends Eloquent{

	/**
	 * A method or function to save module information to the db
	 * @param  [object] $client_data [an object containing json form data]
	 * @return [json]              []
	 */
	public static function create_module($client_data){

		try{

		$input = array('name'=>$client_data->name,/*'display_name'=>$client_data->displayName',*/'role_id'=>$client_data->roleId);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_module_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

		$module_array = HelperFunction::create_audit_entries(HelperFunction::get_user_id());
		$module_array['name'] = $client_data->name;
		$module_array['role_id'] = $client_data->roleId;

		return DataHelper::insert_record('modules',$module_array);

	}catch(Exception $e){
		return HelperFunction::catch_error($e,true);
	}
}
	public static function update_module($client_data){

		try{

		$input = array('name'=>$client_data->name,'role_id'=>$client_data->roleId);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_module_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

		$module_array = HelperFunction::update_audit_entries(HelperFunction::get_user_id());
		$module_array['name'] = $client_data->name;
		$module_array['role_id'] = $client_data->roleId;

		return DataHelper::update_record('modules',$module_array);

	}catch(Exception $e){
		return HelperFunction::catch_error($e,true);
	}
}
	public static function delete_module(){



	}
	public static function get_modules($client_data){

			$filter_array = Array();
			if(array_key_exists('id', $client_data))
				$filter_array['id'] = $client_data['id'];
			if(array_key_exists('name', $client_data))
				$filter_array['name'] = $client_data['name'];
			if(array_key_exists('roleId', $client_data))
				$filter_array['role_id'] = $client_data['roleId'];

			$query_result = DB::table('modules')
							->join('roles','role_id','=','roles.id')
							->where(function($query) use ($filter_array){

								$query = DataHelper::filter_data($query,'id',$filter_array,'int');
								$query = DataHelper::filter_data($query,'name',$filter_array,'string');
								$query = DataHelper::filter_data($query,'role_id',$filter_array,'int');

							})->order_by('modules.id','desc');

			$total = $query_result->count();
			$result = $query_result->get(

					array('modules.id','modules.name','display_name','role_id','roles.name as role_name','priveleges')
				);

			$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['name']		= $data->name;
			$arr['displayName']	= $data->display_name;
			$arr['roleId']		= $data->role_id;
			$arr['roleName']	= $data->role_name;
			$arr['priveleges']	= $data->privileges;
			

			return $arr;
		},$result);
		echo "here";
		return  HelperFunction::return_json_data($out,true,'record loaded',$total);
		
			
	}

}
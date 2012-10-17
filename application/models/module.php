<?php

class Module extends Eloquent{

	/**
	 * A method or function to save module information to the db
	 * @param  [object] $client_data [an object containing json form data]
	 * @return [json]              []
	 */
	public static function create_module($client_data){

		try{

		$inputs = array('name'=>$client_data->name,/*'display_name'=>$client_data->displayName',*/'role_id'=>$client_data->roleId);
		$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_module_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

		$module_array = DataHelper::create_audit_entries(HelperFunction::get_user_id());
		$module_array['name'] = $client_data->name;
		$module_array['list_order'] = $client_data->roleId;
		$module_array['display_name'] = $client_data->name;

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

		$module_array = DataHelper::update_audit_entries(HelperFunction::get_user_id());
		$module_array['name'] = $client_data->name;
		$module_array['list_order'] = $client_data->listOrder;


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
			
			$query_result = DB::table('modules')
							->where(function($query) use ($filter_array){

								$query = DataHelper::filter_data($query,'id',$filter_array,'int');
								$query = DataHelper::filter_data($query,'name',$filter_array,'string');
								

							})->order_by('modules.id','desc');

			$total = $query_result->count();
			$result = $query_result->get(

					array('modules.id','modules.name','display_name')
				);

			$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['name']		= $data->name;
			$arr['displayName']	= $data->display_name;
			//$arr['privileges']	= $data->privileges;
			

			return $arr;
		},$result);
		
		return  HelperFunction::return_json_data($out,true,'record loaded',$total);
		
			
	}
	public static function get_modules_array(){

		$data = DataHelper::return_json_data(HelperFunction::get_config('module_permissions'),true,"data loaded");
		return $data;
	}

}
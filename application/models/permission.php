<?php
	class Permission extends Eloquent{


		public static function create_permission($client_data){

		$arr['role_id'] = $client_data->roleId;
		$arr['securable_id'] = $client_data->securableId;
		//var_dump($client_data->permissions[0]);
		//var_dump($client_data->permissions);
		//return;
		$arr["privileges"] = serialize($client_data->permissions);


		$exists = DB::table('permissions')->where(

				function($query) use($arr) {

					$query->where('securable_id','=',$arr['securable_id']);
					$query->where('role_id','=',$arr['role_id']);
				}
			)->first();
		if(is_null($exists)){

			$inputs = array('role_id'=>$client_data->roleId,'securable_id'=>$client_data->securableId);
			$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_permisson_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

			$permissions_array = DataHelper::create_audit_entries(HelperFunction::get_user_id());
			$permissions_array['role_id'] = $arr['role_id'];
			$permissions_array['securable_id'] = $arr['securable_id'];
			$permissions_array['privileges'] = $arr["privileges"];

		return DataHelper::insert_record('permissions',$permissions_array);

		}else{

			//Do an Update here
			$update_array = DataHelper::update_audit_entries(HelperFunction::get_user_id());
			$update_array['role_id'] = $arr['role_id'];
			$update_array['securable_id'] = $arr['securable_id'];
			$update_array['priveliges'] = $arr["privileges"];

				 DB::table('permissions')->where(
					function($query) use($update_array) {
						$query->where('securable_id','=',$update_array['securable_id']);
						$query->where('role_id','=',$update_array['role_id']);
					}
			)->update(
				$arr_upate = $arr
			);
			return DataHelper::return_json_data($arr_upate,true,"Securable Permissions Updated");
		}
		

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
	public static function get_permissions($client_data){

		
		$filter_array = Array();
			if(array_key_exists('roleId', $client_data))
				$filter_array['role_id'] = $client_data['roleId'];
			if(array_key_exists('securableId', $client_data))
				$filter_array['securable_id'] = $client_data['securableId'];
		$selectQuery = DB::table('permissions')
				->where(function($query) use ($filter_array){

					
						$query = HelperFunction::filter_data($query,'role_id',$filter_array,'string');
						$query = HelperFunction::filter_data($query,'securable_id',$filter_array,'string');

				})
				->order_by('id','desc');
		//get total count 
		$total =$selectQuery->count();
		$result = $selectQuery->get(array('privileges'));
		// var_dump($result);
		// return;
		if($result){
				$out = unserialize($result[0]->privileges);
				//$arr[]	= $out;
				return  HelperFunction::return_json_data($out,true,'record loaded',$total);
		}
		else{
				return  HelperFunction::return_json_data(array(),true,'record loaded',$total);
		}
		
				
		$data = HelperFunction::return_json_data($out,true,'record loaded',$total);
		return $data;
	}

	}
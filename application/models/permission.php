<?php
	class Permission extends Eloquent{


		public static function create_permission($client_data){

		$arr['role_id'] = $client_data->roleId;
		$arr['securable_id'] = $client_data->securableId;
		$arr["privileges"] = serialize($client_data->permissions[0]);


		$exists = DB::table('permissions')->where(

				function($query) use($filter_array) {

					$query->where('securable_id','=',$filter_array['securable_id']);
					$query->where('role_id','=',$filter_array['role_id']);
				}
			)->first();
		if($exists){

			$input = array('role_id'=>$client_data->roleId,'securable_id'=>$client_data->securable_id);
			$validation = MyValidator::validate_user_input($inputs,HelperFunction::get_config_value('create_permisson_rule'));
			if($validation->fails())
				return HelperFunction::catch_error(null,false,HelperFunction::format_message($validation->errors->all()));

			array_push($arr, HelperFunction::create_audit_entries(HelperFunction::get_user_id()));
			// $permissions_array['role_id'] = $arr['role_id'];
			// $permissions_array['securable_id'] = $arr->displayName;
			// $permissions_array['priveleges'] = $client_data->roleId;

		return DataHelper::insert_record('permissions',$arr);

		}else{

			//Do an Update here
				 DB::table('permissions')->where(
					function($query) use($filter_array) {
						$query->where('securable_id','=',$ar['securable_id']);
						$query->where('role_id','=',$arr['role_id']);
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
	public static function get_permissions($obj){


		$selectQuery = DB::table('permissions')
				->where(function($query) use ($obj){

					
						$query = HelperFunction::filter_data($query,'role_id',$obj,'string');
						$query = HelperFunction::filter_data($query,'securable_id',$obj,'string');

				})
				->order_by('id','desc');
		//get total count 
		$total =$selectQuery->count();
		$result = $selectQuery->get(array('priveleges'));
		if($result){
				$out = unserialize($result[0]->privileges);
				$arr[]	= $out;
				return  HelperFunction::return_json_data($arr,true,'record loaded',$total);
		}
		else{
				return  HelperFunction::return_json_data(array(),true,'record loaded',$total);
		}
		
				
		$data = HelperFunction::return_json_data($out,true,'record loaded',$total);
		return $data;
	}

	}
<?php

class Role extends Eloquent{
	
	
	public static function create_role($role){

			try{
				
			$validation = MyValidator::validate_user_input(array('name'=>$project->name),HelperFunction::get_config_value('default_lookup_rules'));
			if($validation->fails())
					return $validation->errors;
				
				$arr = DataHelper::create_audit_entries(Auth::user()->id);
	            $arr['name'] = $project->name;
	            $arr['description'] = $project->description;

	            $inserted_record = DataHelper::insert_record('roles',$arr);
	            return $inserted_record;

           }catch(Exception $e){

           		return HelperFunction::catch_error($e,true,HelperFunction::get_admin_error_msg());
           }
	}
	public static function update_role($role){

			try{
			
			$validation = MyValidator::validate_user_input(array('name'=>$project->name),HelperFunction::get_config_value('default_lookup_rules'));
			if($validation->fails())
					return HelperFunction::catch_error(null,false,$validation->errors.all());

			$project = DataHelper::update_audit_entries(HelperFunction::get_user_id());
            $project['name'] = $project->name;
            $project['description'] = $project->description;
            
            $updated_record = DataHelper::update_record('projects',$project->id,$project);
            return $updated_record;

        }catch(Exception $e){
        	return HelperFunction::catch_error($e,true,HelperFunction::get_admin_error_msg());
        }
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
<?php

class ProjectUserGroup extends Eloquent{

	public static function create_project_user_group($project_user_group){

			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
            $grp_array['project_group_id'] = $project_user_group->projectGroupId;
            $grp_array['user_id'] = $project_user_group->projectId;
            
            $inserted_record = DataHelper::insert_record('project_user_groups',$grp_array);
            return $inserted_record;
	}
	public static function update_project_user_group($project_user_group){

		$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
        $grp_array['project_group_id'] = $project_user_group->projectGroupId;
        $grp_array['user_id'] = $project_user_group->userId;
        
        $inserted_record = DataHelper::insert_record('project_user_groups',$grp_array);
        return $inserted_record;
	}
	public static function delete_project_user_group(){

		//return DB::table('project_user_groups')->delete($id);
	}
	public static function get_project_user_groups(){

		$selectQuery = DB::table('project_user_groups')
				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'project_group_id',$obj,'int');
						$query = HelperFunction::filter_data($query,'user_id',$obj,'string');
				});

		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}



}
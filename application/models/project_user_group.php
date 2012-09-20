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
	public static function get_project_user_groups($obj){

		$selectQuery = DB::table('project_user_groups')
				->join('users','project_user_groups.user_id','=','users.id')
				->join('project_groups','project_user_groups.project_group_id','=','project_groups.id')
				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'project_group_id',$obj,'int');
						$query = HelperFunction::filter_data($query,'user_id',$obj,'string');
				})
				->order_by('project_user_groups.created_at','desc');
				$total = $selectQuery->count();
				$result_set = $selectQuery->get(

						array(
							'project_user_groups.project_group_id','project_groups.name as project_group','project_user_groups.user_id',
								'users.first_name','users.last_name','project_user_groups.created_at'

							)
					);

				$out = array_map(function($data){

					$array['projectGroupId'] = $data->project_group_id;
					$array['projectGroup']	 = $data->project_group;
					$array['userId']		 = $data->user_id;
					$array['firstName']		 = $data->first_name;
					$array['lastName']		 = $data->last_name;
					$array['createdAt']		 = $data->created_at;

				},$result_set);
		//$out
		$data = HelperFunction::return_json_data($out,true,'record loaded',$total);
		return $data;
	}



}
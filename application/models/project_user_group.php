<?php

class ProjectUserGroup extends Eloquent{

	public static function create_project_user_group($project_user_group){

			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);

            $grp_array['project_group_id'] = $project_user_group->projectGroupId;
            $grp_array['user_id'] = $project_user_group->userId;
            
            $inserted_record = DataHelper::insert_record('project_user_groups',$grp_array);
            return $inserted_record;
	}
	public static function update_project_user_group($project_user_group){

		$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
        $grp_array['project_group_id'] = $project_user_group->projectGroupId;
        $grp_array['user_id'] = $project_user_group->userId;
        
        $inserted_record = DataHelper::update_record('project_user_groups',$grp_array);
        return $inserted_record;
	}
	public static function delete_project_user_group(){

		//return DB::table('project_user_groups')->delete($id);
	}
	public static function get_project_user_groups($obj){

		$filter_array = array();
		var_dump($obj);
		if(!is_object($obj))
			$filter_array['user_id'] = Auth::user()->id;
		if(array_key_exists("projectId", $obj))
			$filter_array['project_id'] = $obj['projectId'];
		if(array_key_exists("userId", $obj))
			$filter_array['user_id'] = $obj['userId'];

		// $selectQuery = DB::query('select u.first_name,u.last_name,pg.name,pg.project_id,pug.project_group_id,p.name as projectname
		// 							from users u,project_groups pg,project_user_groups pug,projects p
		// 								where u.id = pug.user_id and pg.id = pug.project_group_id and p.id = pg.project_id
		// 									and u.id = ?',array(13));

		$selectQuery = DB::table('project_user_groups')
				->join('users','project_user_groups.user_id','=','users.id')
				->join('project_groups','project_user_groups.project_group_id','=','project_groups.id')
				->join('projects','projects.id','=','project_groups.project_id')
				->where(function($query) use ($filter_array){

						$query = HelperFunction::filter_data($query,'project_id',$filter_array,'int');
						$query = HelperFunction::filter_data($query,'user_id',$filter_array,'int');
				})
				->order_by('project_user_groups.created_at','desc');
				$total = $selectQuery->count();
				$result_set = $selectQuery->get(

						array(
							'project_user_groups.project_group_id','project_groups.name as name','project_user_groups.user_id','first_name',
								'users.first_name','users.last_name','project_user_groups.created_at','project_groups.project_id',
									'projects.name as projectname'
							)
					);
				
				$out = array_map(function($data){

					$array['projectGroupId'] = $data->project_group_id;
					$array['groupName'] 	 = $data->name;
					$array['projectName']	 = $data->projectname;
					$array['name']	 		 = $data->first_name . ' ' . $data->last_name;
					$array['userId']		 = $data->user_id;
					$array['firstName']		 = $data->first_name;
					$array['lastName']		 = $data->last_name;
					$array['createdAt']		 = $data->created_at;
					$array['projectId']		 = $data->project_id;

					return $array;
				},$result_set);
		//$out
		//return DataHelper::return_json_data($selectQuery,true,'record loaded',0);
		return DataHelper::return_json_data($out,true,'record loaded',$total);
		//return $data;
	}
	



}
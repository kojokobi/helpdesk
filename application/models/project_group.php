<?php

class ProjectGroup extends Eloquent{
	

	/**
	 * Inserts a new record into the group table
	 * @param   [object]        $group  [arrayarray of group fields
	 * @return  [int]           [json containing Id of record created and other properties]
	 */
	public static function create_project_group($project_group){

			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);

            $grp_array['name'] = $project_group->name;
            $grp_array['project_id'] = $project_group->projectId;
            $grp_array['description'] = $project_group->description;

            $inserted_record = DataHelper::insert_record('project_groups',$grp_array);
            return $inserted_record;

	}
	/**
	 * [update]
	 * @param  array
	 * @return [type]
	 */
	public static function update_project_group($project_group){

			$grp_array = DataHelper::update_audit_entries(Auth::user()->id);

            $grp_array['name'] = $project_group->name;
            $grp_array['project_id'] = $project_group->projectId;
            $grp_array['description'] = $project_group->description;
            
            $updated_record = DataHelper::update_record('groups',$group->id,$grp_array);
            return $updated_record;
	}
	public static function delete_project_group($groupId){

		//DB::table('groups')->where('id','=',$groupId)->delete();
		return DB::table('groups')->delete($id);
	}
	public static function get_project_groups($obj){

		$new_filter_array = array();
		if(array_key_exists("projectId", $obj))
			$new_filter_array['project_id']  = $obj['projectId'];
		if(array_key_exists("name", $obj))
			$new_filter_array['name']  = $obj['name'];

		$selectQuery = DB::table('project_groups')
				->join('projects','project_groups.project_id','=','projects.id')
				->where(function($query) use ($new_filter_array){


						$query = DataHelper::filter_data($query,'project_groups.id',$new_filter_array,'int');
						$query = DataHelper::filter_data($query,'name',$new_filter_array,'string');
						$query = DataHelper::filter_data($query,'project_id',$new_filter_array,'int');

				})
		->order_by('project_groups.id','desc');
		//get total count 
		$total =$selectQuery->count();
		$result_set = $selectQuery->get(

			array(
					'project_groups.id as id','project_groups.name as project_group_name','project_groups.project_id','projects.name as project_name',
						'project_groups.description','project_groups.created_at'
						)
		);
		//var_dump($selectQuery);
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['name']		= $data->project_group_name;
			$arr['projectId']	= $data->project_id;
			$arr['projectName']	= $data->project_name;
			$arr['description']	= $data->description;
			$arr['createdAt']	= $data->created_at;
			

			return $arr;
		},$result_set);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);

		//$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		//return $data;
	}
}
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

		$selectQuery = DB::table('project_groups')
				->join('projects','project_groups.project_id','=','projects.id')
				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
						$query = HelperFunction::filter_data($query,'project_id',$obj,'int');

				})
		->order_by('project_groups.id','desc');
		//get total count 
		$total =$selectQuery->count();
		$resultSet = $selectQuery->get(
			'project_groups.id as id','project_groups.name','project_groups.project_id','projects.name as project_name',
				'project_groups.description','project_groups.created_at'
		);
		
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['name']		= $data->name;
			$arr['projectId']	= $data->project_id;
			$arr['projectName']	= $data->project_name;
			$arr['description']	= $data->description;
			$arr['createdAt']	= $data->created_at;
			

			return $arr;
		},$resultSet);

		return HelperFunction::return_json_data($out,true,'record loaded',$total);

		//$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		//return $data;
	}
}
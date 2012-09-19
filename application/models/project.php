<?php

class Project extends Eloquent {
	
	public static function create_project($project){

			$project = DataHelper::create_audit_entries(Auth::user()->id);
            $project['name'] = $project->name;
            $project['description'] = $project->description;

            $inserted_record = DataHelper::insert_record('projects',$project);
            return $inserted_record;
			
	}
	public static function update_project($project){


			$project = DataHelper::update_audit_entries(Auth::user()->id);
            $project['name'] = $project->name;
            $project['description'] = $project->description;
            //update_record($table_name,$value,$update_parameters_array,$key='id',$operator='=',)
            $updated_record = DataHelper::update_record('projects',$project->id,$project);
            return $updated_record;
	}
	public static function delete_project($projectId){

		//DB::table('projects')->where('id','=',$projectId)->delete();
		return  DB::table('projects')->delete($id);
	}
	public static function get_projects($obj = null){

		$selectQuery = DB::table('projects')

				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');

				});
				
		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
		
	}
	
}
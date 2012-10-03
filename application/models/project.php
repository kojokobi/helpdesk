<?php

class Project extends Eloquent {
	
	public static function create_project($project){

		try{
				// $validation_error = MyValidator::validate_lookup(true,$project);
				// var_dump($validation_error);
				// if(!$validation_error)
				// 	return $validation_error;
				
				$arr = DataHelper::create_audit_entries(Auth::user()->id);
	            $arr['name'] = $project->name;
	            $arr['description'] = $project->description;

	            $inserted_record = DataHelper::insert_record('projects',$arr);
	            return $inserted_record;

           }catch(Exception $e){

           		return HelperFunction::catch_error($e,true,HelperFunction::get_admin_error_msg());
           }
			
	}
	public static function update_project($project){

		try{
			$validation_error = HelperFunction::validate_lookup(false);
			if($validation_error)
				return $validation_error->errors;

			$project = DataHelper::update_audit_entries(Auth::user()->id);
            $project['name'] = $project->name;
            $project['description'] = $project->description;
            
            $updated_record = DataHelper::update_record('projects',$project->id,$project);
            return $updated_record;

        }catch(Exception $e){
        	return HelperFunction::catch_error($e,true,HelperFunction::get_admin_error_msg());
        }
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

				})
				->order_by('id','desc');
		//get total count 
		$total =$selectQuery->count();
		$resultSet = $selectQuery->get();
	
		$out = array_map(function($data){

			$arr = array();
			$arr['id'] 			= $data->id;
			$arr['name']		= $data->name;
			$arr['description']	= $data->description;
			$arr['createdAt']	= $data->created_at;
			

			return $arr;
		},$resultSet);
				
		$data = HelperFunction::return_json_data($out,true,'record loaded',$total);
		return $data;
		
	}
	
}
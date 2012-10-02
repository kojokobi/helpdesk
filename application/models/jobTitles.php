<?php

class JobTitle extends Eloquent{

	
	public static function create_jobtitle($jobTitle){

		try{

			var $validator = Validator::validate_lookup();
			if(!$validator)
				return $validator;

			$job_title_array = DataHelper::create_audit_entries(Auth::user()->id);
			$job_title_array['name'] = $jobTitle->name;
            $job_title_array['description'] = $jobTitle->description;
			
            $inserted_record = DataHelper::insert_record('job_titles',$job_title_array);
            return $inserted_record;

        }catch(){
        	return HelperFunction::catch_error($e,true,Config::get("globalconfig.global_error_message"));
        }
	}
	public static function update_jobTitle($jobTitle){

			try{

			var $validator = Validator::validate_lookup(false);
			if(!$validator)
				return $validator;
			
			$job_title_array = DataHelper::update_audit_entries(Auth::user()->id);
			$job_title_array['id'] = $jobTitle->name;
			$job_title_array['name'] = $jobTitle->name;
            $job_title_array['description'] = $jobTitle->description;
			
            $inserted_record = DataHelper::insert_record('job_titles',$job_title_array);
            return $inserted_record;

        }catch(){
        	return HelperFunction::catch_error($e,true,Config::get("globalconfig.global_error_message"));
        }
	}
	public static function delete_jobTitle($jobTitleId){

		//DB::table('jobTitles')->where('id','=',$jobTitleId)->delete();
		DB:table('jobTitles')->where('id','=',$jobTitleId)->delete();
	}
	public static function get_jobTitles($obj = null){

		$selectQuery = DB::table('job_titles')
				->where(function($query) use ($obj){
						
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
						$query = HelperFunction::filter_data($query,'id',$obj,'int');
				});
		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
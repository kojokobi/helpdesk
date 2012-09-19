<?php

class JobTitle extends Eloquent{

	
	public static function create_jobtitle($jobTitle){

			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			//add created and lastUpdated date to $jobTitle array
			$jobTitle['createdDate'] = $createdDate;
			$jobTitle['lastUpdateDate'] = $lastUpdatedDate;

			$jobTitleId = DB::table('job_titles')->insert_get_id(
					$arrayName	=	$jobTitle
				);

			$arrayName['id'] = $jobTitleId;
			return $arrayName;
	}
	public static function update_jobTitle($jobTitle){

			$lastUpdateDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			$jobTitle['$lastUpdateDate'] = $lastUpdateDate;

			$update = DB::table('job_titles')
						->where('id','=',$jobTitle['id'])
						->update(
							$arrayName = array(
								$jobTitle
							)
						);
			return $arrayName;
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
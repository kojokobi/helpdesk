<?php

class Project extends Eloquent {
	
	public static function create_project($project){

			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			$id = DB::table('projects')->insert_get_id(

					$arrayName = array(

							'name' =>	$project['name'],
							'title'=>	$project['title'],
							'description'	=> $project['description'],
							'createdDate' 	=> $createdDate,
							'lastUpdateDate' => $lastUpdatedDate,
							'createdBy'		=>	$project['createdBy'],
							'lastUpdateBy'	=>	$project['lastUpdateBy']
						)
				);

		$data = HelperFunction::return_json_data(array('id' => $id),true,'record saved');
		return $data;
			
	}
	public static function update_project($project){


			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$update = DB::table('projects')
						->where('id','=',$project['id'])
						->update($arrayName = array(

							'id' =>		$project['id'],
							'name' =>	$project['name'],
							'description'	=> $project['description'],
							'lastUpdateDate' => $lastUpdatedDate,
							'lastUpdateBy'	=>	$project['lastUpdateBy']

							)
						);
			$data = HelperFunction::return_json_data($arrayName,true,'record saved');
			return $data;
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
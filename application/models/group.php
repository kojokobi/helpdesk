<?php

class Group extends Eloquent{

	
	
	/**
	 * Function that creates a new group
	 * @param  array of group fields
	 * @return json containing Id of record created and other properties
	 */
	public static function create_group($group){

			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			$id = Db::table('groups')->insert_get_id(

					$arrayName = array(

							'name' =>	$group['name'],
							'description'	=> $group['description'],
							'createdDate' 	=>  $createdDate,
							'lastUpdateDate' => $lastUpdateDate,
							'createdBy'		=>	$group['createdBy'],
							'lastUpdateBy'	=>	$group['lastUpdateBy']
						)
				);

			$data = HelperFunction::return_json_data($id,true,'record saved');
			return $data;
	}
	/**
	 * [update]
	 * @param  array
	 * @return [type]
	 */
	public static function update_group($group){


			$createdDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));
			$lastUpdatedDate = new Datetime(null, new DateTimeZone('Pacific/Nauru'));

			$update = DB::table('groups')

						->where('id','=',$group['id'])
						->update($arrayName = array(

							'id' =>		$group['id'],
							'name' =>	$group['name'],
							'description'	=> $group['description'],
							'lastUpdateDate' => $lastUpdateDate,
							'lastUpdateBy'	=>	$group['lastUpdateBy']

							)
						);
			$data = HelperFunction::return_json_data($update,true,'record updated succesfully');
			return $data;
	}
	public static function delete_group($groupId){

		//DB::table('groups')->where('id','=',$groupId)->delete();
		return DB:table('groups')->delete($id);
	}
	public static function get_groups($obj){

		$selectQuery = DB::table('groups')
				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');

				})

		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',selectQuery->count());
		return $data;
	}
}
<?php

class Group extends Eloquent{
	
	/**
	 * Inserts a new record into the group table
	 * @param   [object]        $group  [arrayarray of group fields
	 * @return  [int]           [json containing Id of record created and other properties]
	 */
	public static function create_group($group){
		//$exception=null,$is_error=true,$message=""
		try{
			
			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
            $grp_array['name'] = $group->name;
            $grp_array['project_id'] = $group->project_id;
            $grp_array['description'] = $group->description;

            $inserted_record = DataHelper::insert_record('project_groups',$grp_array);
            return $inserted_record;

        }catch(Exception $e){
            return HelperFunction::catch_error($e,true,Config::get("globalconfig.global_error_message", $default));
        }
	}
	/**
	 * [update]
	 * @param  array
	 * @return [type]
	 */
	public static function update_group($group){

			$grp_array = DataHelper::update_audit_entries(Auth::user()->id);
            $grp_array['name'] = $group->name;
            $grp_array['project_id'] = $group->project_id;
            $grp_array['description'] = $group->description;
            //update_record($table_name,$value,$update_parameters_array,$key='id',$operator='=',)
            $updated_record = DataHelper::update_record('groups',$group->id,$grp_array);
            return $updated_record;
	}
	public static function delete_group($groupId){

		//DB::table('groups')->where('id','=',$groupId)->delete();
		return DB::table('groups')->delete($id);
	}
	public static function get_groups($obj){

		$selectQuery = DB::table('groups')
				->where(function($query) use ($obj){

						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
						$query = HelperFunction::filter_data($query,'project_id',$obj,'int');

				});

		$data = HelperFunction::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
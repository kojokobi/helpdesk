<?php

class Priority extends Eloquent{
	
	
	public static function create_priority($priority){

			$grp_array = DataHelper::create_audit_entries(Auth::user()->id);
            $grp_array['name'] = $priority->name;
            $grp_array['description'] = $priority->description;

            $inserted_record = DataHelper::insert_record('priorities',$grp_array);
            return $inserted_record;
	}
	public static function update_priority($priority){

			$grp_array = DataHelper::update_audit_entries(Auth::user()->id);
            $grp_array['name'] = $priority->name;
            $grp_array['description'] = $priority->description;

            $inserted_record = DataHelper::update_record('priorities',$grp_array);
            return $inserted_record;
	}
	public static function delete_priority($priorityId){

		DB::table('priorities')->delete($priorityId);

	}
	public static function get_priorities($obj = null){

		$selectQuery = DB::table('priorities')

					->where(function($query) use ($obj){
						$query = HelperFunction::filter_data($query,'id',$obj,'int');
						$query = HelperFunction::filter_data($query,'name',$obj,'string');
				});
					
		$data = DataHelper::return_json_data($selectQuery->get(),true,'record loaded',$selectQuery->count());
		return $data;
	}
}
<?php

class HelperFunction extends Eloquent{

	/*
	
	*/
	private function messages (){

		return array(

				'successfullSave'	=>	'saved successfully',
				'failedSave'		=>	'failed to save record.contact your admin for further assistance',
				'successfullUpdate'	=>	'record updated successfully',
				'failedUpdate'		=>	'record updated successfully',
			);
	}
	public static function return_json_data($data =null,$success = false,$message="",$total=0){
		
		$dataToReturn = array(

			'data' 		=>	$data,
			'success' 	=>	$success,
			'message' 	=>	$message,
			'total'		=>	$total,

			);
		return $dataToReturn;
	}
	public static function success_save_message(){

		return 'record saved successfully';
	}
	public static function success_update_message(){

		return 'record updated successfully';
	}
	public static function failed_save_message(){
		return "failed to save record.contact your admin for further assistance";
	}
	public static function filter_data($query = null,$key='id',$array = null,$type='int'){
				
				if($query == null or $array == null) return;
				switch ($type) {

					case 'int':
						if(array_key_exists($key, $array))
						{
								$query -> where($key,'=',$array[$key]);
						}
						break;
					default:
						
						if(array_key_exists($key, $array))
						{
							if($key != '')
								$query -> where($key,'=',$array[$key]);
						}
						break;
				}
				return $query;
	}
	public static function get_date($format='Y-m-d'){
		return Date($format);
	}

	public static function get_user_id(){
		return 1;
	}
	/**
	 * converts field names containing underscores to camel casing
	 * @param  [array] $list[a list of field names.a field can or can not contain underscores]
	 * @return [type]       [description]
	 */
	public function array_mapper($fields){

		//ticket_id
		foreach ($fields as $field) {

			# if $field contans an underscore, split by the underscore
			if($field)
		}
	}
}
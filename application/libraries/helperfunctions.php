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
	public static function get_date($format='Y-m-d H:i:s'){
		return Date($format);
	}
	public static function get_user_id(){
		return Auth::user()->id;
		
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
			//if($field)
		}
	}
	/**
	 * use to determine  messages to send to the client side when an error occurs.
	 * @param  [type]  $exception [the exception that occured]
	 * @param  boolean $is_error  [whether an error or a validation failure]
	 * @return [type]             [returns a json object]
	 */
	public static function catch_error($exception=null,$is_error=true,$message=""){
    //$data =null,$success = false,$message="",$total=0
    try{
    	    //get config value with key 'environment' from the globalconfig file.
			$env = Config::get('globalconfig.environment','development');
			if($is_error)
			{
				if($env === 'development')
                    return DataHelper::return_json_data(null,false,HelperFunction::format_exception($exception));
				return DataHelper::return_json_data(null,false,$message);
			}
			return DataHelper::return_json_data(null,false,$message);

	}catch(Exception $e){
      return DataHelper::return_json_data(null,false,"an error occured.contact your system admin");
	}

	}
	public static function get_admin_error_msg(){

		return Config::get("globalconfig.global_error_message");
	}
	publick static function get_config($config_key){

		return Config::get('globalconfig.'.$config_key);
	}
	public static function get_config_value($config_key)
	{
		//var_dump($config_key);
		return Config::get('validationconfig.'.$config_key);
	}

	private static function format_exception($exception){

		$message = $exception->getMessage(). 'On Line Number-> '. $exception->getLine().
					'<br>In file '. $exception->getFile();
		return $message;
	}
	public static function format_message($validation){

			$message= "";
			foreach ($validation as $key => $value) {

					$message = $message . $value . "<br>";
				}
			return $message;
	}
}
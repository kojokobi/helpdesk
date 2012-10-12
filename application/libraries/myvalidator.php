<?php

class MyValidator extends Eloquent{

	/**
	 * Performs laravel validation based 
	 * @param  [array] $input [array containing data to be validation]
	 * @param  [array] $rules [array containing rules to to validate against]
	 * @return [object]        [validation object]
	 */
	public static function validate_user_input($input,$rules){
      
      try{
      		 
	         $validation =  Validator::make($input,$rules);
	         return $validation;

     }catch(Exception $e)
     {
     	var_dump($e);
     }
	}
	public static function validate_lookup($is_insert = true,$input){
		try{
			
			$input = array('name'	=> $input->name);
			$rules = array('name'	=> 'required');

			if(!$is_insert){
				$input['id'] = $input->id;
				$rules['id'] = 'required|numeric';
			}

			$validation = Validator::make($input,$rules);
			return $validation;

		}catch(Exception $e){
			var_dump($e);
		}

	}

	public static function is_unique(){

	}

}
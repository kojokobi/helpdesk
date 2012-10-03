<?php

class MyValidator extends Eloquent{


	public static function validate_user_input($input,$rules){
      
         $validation =  Validator::make($input,$rules);
         return $validation;
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
			//var_dump($validation);
			if($validation->fails())
				return $validation->errors;
			else
				return false;

		}catch(Exception $e){
			var_dump($e);
		}

	}

	public static function is_unique(){

	}

}
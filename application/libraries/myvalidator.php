<?php

class MyValidator {


	public static function validate_user_input($input,$rules){
      
         $validation =  Validator::make($input,$rules);
         return $validation;
	}
	public static function validate_lookup($is_insert=true){

			$input = array('name'	=> 'name',);
			$rules = array('name'	=> 'required');

			if(!$is_insert){
				$input['id'] = 'id';
				$rules['id'] = 'required|numeric';
			}

			$validation = Validator::make($input,$rules)
			if($validation->fails())
				return $validation->errors;
			return true;

	}
	public static function is_unique(){

	}
}
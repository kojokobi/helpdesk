<?php

class Security {

	public function login($credentials){
		
		return   Auth::attempt(
					$credentials
				);
	}
	public function logout(){

		return Auth::logout();
	}

}
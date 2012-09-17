<?php

class Security Extends Eloquent{

	public function login($credentials){
		
		//echo Hash::make($credentials['password']);
		$password = DB::table('users')
					->where('username','=',$credentials['username'])
					->only('password');

		if($password == $credentials['password'])
			return true;
		else
			return false;
		
		// var_dump($password);
		// echo $credentials['password'];
		// if(Hash::check($credentials['password'],$password))
		// 	echo "  i  beg work okay";
		// else
		// 	echo "  i wont";

		// $authenStatus = Auth::attempt(array(
                    
		// 			'username'=>$credentials['username'],
		// 			//'password'=>Hash::make($credentials['password'])
		// 			'password'=>$credentials['password']
		// 		)
		// 	);
		//$user = Auth::user();
		//var_dump($user);
		return $authenStatus;		
	}
	public function logout(){

		return Auth::logout();
	}

}
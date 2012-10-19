<?php

return array(

			/*
			|--------------------------------------------------------------------------
			| Default validation lookUp rule
			|--------------------------------------------------------------------------
			|The default validation rule for any look up table
			|which has the following columns id,name description.
			|This validation rule should be applied during inserts
			*/
			'default_lookup_rules' => array('name'=>'required|max:128'),
			/*
			|--------------------------------------------------------------------------
			| Default lookup update validation rule
			|--------------------------------------------------------------------------
			|The default validation rule for any look up table
			|which has the following columns id,name description.
			|This validation rule should be applied during updates
			|
			*/
			'default_loolup_update_rules' => array('id'=>'required|numeric','name'=>'required|max:128'),
			/*
			|--------------------------------------------------------------------------
			| User model validation rule
			|--------------------------------------------------------------------------
			|Validation rules to be applied to the user model before a save or update operation
			*/
			'user_rules' => array('firstName'=>'required|max:128','lastName'=>'required|max:128','email'=>'required|email',
										'password'=>'required|max:128','userName'=>'required|max:128','jobTitleId'=>'required|numeric',
												'roleId'=>'required|numeric'),
			/*
			|--------------------------------------------------------------------------
			| User model update_user_profile rules
			|--------------------------------------------------------------------------
			|Validation rules to be applied to the user model before a profile update
			*/
			'update_user_profile_rule' => array('firstName'=>'required|max:128','lastName'=>'required|max:128','email'=>'required|email','userName'=>'required|max:128'),
			/*
			|--------------------------------------------------------------------------
			| User model change password validation rule
			|--------------------------------------------------------------------------
			|Validation rules to be applied to the user model when changing a password
			*/
			'change_password' => array('oldPassword'=>'required|max:128','newPassword'=>'required|max:128','confirmPassword'=>'required|max:128'),
			/*
			|--------------------------------------------------------------------------
			| Module validation rule
			|--------------------------------------------------------------------------
			|Validation rules to be applied to the module entity
			*/
			'create_module_rule' => array('name'=>'required|max:128','role_id'=>'required|numeric'),
			/*
			|--------------------------------------------------------------------------
			| Permissions Validation Rule
			|--------------------------------------------------------------------------
			|Validation rules to be applied to the Permissions entity
			*/
			'create_permisson_rule' => array('role_id'=>'required|numeric','securable_id'=>'required|numeric'),
			/*
			|--------------------------------------------------------------------------
			| Securable Validation Rule
			|--------------------------------------------------------------------------
			|Securable Validation rule
			*/
			'create_module_permission_rule' => array('moduleId'=>'required|numeric','roleId'=>'required|numeric','permissions'=>'required'),

		);
		
		

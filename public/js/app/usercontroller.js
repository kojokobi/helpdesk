function UserController ($scope, User,$http,MSG,OBJ){
	
	var userDefault = {
		id : "",
		firstName : "",
		lastName : "",
		userName : "",
		email : "",
		password : "",
		jobTitleId : "",
		roleId : ""
	};
	
	var userForm = $("#user_form");
	
	$scope.formTitle = "Add User";
	$scope.users = [];
	$scope.reload = function (){
		getUsers();
	}

	var getUsers = function (){
		User.query(function (res){
			$scope.users = angular.copy(res.data);
		});
	}

	function getRoles(){
		$http.get('roles').success(function (res){
			$scope.roles = res.data;
		});
	}

	function getJobTitles(){
		$http.get('jobtitles').success(function (res){
			$scope.jobTitles = res.data;
		});
	}

	//todo	refactor to use structure in securables
	$scope.addUser =  function (newUser){
		var msg = "";
		var user =  OBJ.rectify( angular.copy(newUser), userDefault);
		if (user["id"]){
			User.update(newUser, function (res){
				afterSave(res,{message : "User Updated."});
			});
		}else {
			var theUser = new User(user);
			theUser.$save(function (res){
				afterSave(res,{message : "User Created."});
			});
		}
	}


	/**
	 * Method to be run after saving /updating a record
	 * @param  {object}   res      the response from the server
	 * @param  {object}   obj      an object containing extra info to be used id no response is sent
	 * @param  {Function} callback an additional callback function that we might want to run
	 * @return {[void]}     
	 */
	function afterSave(res,obj,callback){
		var msg = "";
		if(res.success){
			//reload data into grid
			getUsers();
			msg = res.message || obj.message || "User Saved";
			MSG.show(msg,"success");
			$scope.clear();
			userForm.modal("hide");
			
			//any other business
			if(callback)
				callback();
		}else {
			msg = res.message || obj.message || "Sorry, errors were ecountered";
			MSG.show(msg);
		}
	}


	$scope.showNewUser = function (){
		loadDropDowns();
		$scope.clear();
		$scope.formTitle =  "Add User";
	}

	/**
	 * This brings up the form and preloaded with the user's data
	 * @param  {object} user the user object
	 * @return {void}
	 */
	$scope.editUser = function (user){
		loadDropDowns();
		$scope.formTitle = "Edit User";
		userForm.modal("show");
		$scope.newUser = angular.copy(user);
	}

	/**
	 * deletes the user
	 * @param  {object} user the user object
	 * @return {void}   
	 */
	$scope.deleteUser = function(user){

	}

	$scope.clear =  function (){
		$scope.newUser = {};
	}

	function loadDropDowns() {
		getRoles();
		getJobTitles();
	}

	//make calls here
	getUsers();
	
}
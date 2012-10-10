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

	function getUsers(){
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

	$scope.addUser =  function (newUser){
		var user =  OBJ.rectify( angular.copy(newUser), userDefault);
		if (user["id"]){
			User.update(newUser, function (res){
				if (res.success){
					getUsers();
					$scope.clear();
				}else {

				}
			});
			
		}else {
			var theUser = new User(user);
			theUser.$save(function (res){
				//fetch fresh items
				var msg = "";
				if(res.success){
					getUsers();
					msg = res.message || "User created"; 
					MSG.show(msg,"success");
					$scope.clear();	
					userForm.modal("hide");
				}else {
					msg = res.message || "Sorry errors were ecountered"; 
					MSG.show(msg);
				}
				
			});
		}
	}

	$scope.clear =  function (){
		$scope.newUser = {};
		//$scope.title = "Add New User";
		//$scope.statusText = "Add User";
	}


	//make calls here
	getUsers();
	getRoles();
	getJobTitles();
}